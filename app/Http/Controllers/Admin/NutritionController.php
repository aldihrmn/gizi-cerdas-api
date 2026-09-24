<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\GrowthStandard;
use App\Models\NutritionCalculation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NutritionController extends Controller
{
    public function index()
    {
        $calculations = NutritionCalculation::with('child.user')
            ->orderBy('calculation_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.nutrition.index', compact('calculations'));
    }

    public function create()
    {
        $children = Child::with('user')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.nutrition.create', compact('children'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'calculation_date' => 'required|date',
            'weight' => 'required|numeric|min:0.1',
            'height' => 'required|numeric|min:1',
        ], [
            'child_id.required' => 'Anak wajib dipilih.',
            'child_id.exists' => 'Data anak tidak ditemukan.',
            'calculation_date.required' => 'Tanggal perhitungan wajib diisi.',
            'calculation_date.date' => 'Tanggal perhitungan tidak valid.',
            'weight.required' => 'Berat badan wajib diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'height.required' => 'Tinggi badan wajib diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
        ]);

        $result = $this->calculateNutrition(
            $request->child_id,
            $request->calculation_date,
            $request->weight,
            $request->height
        );

        NutritionCalculation::create([
            'child_id' => $result['child']->id,
            'calculation_date' => $request->calculation_date,
            'age_in_months' => $result['ageInMonths'],
            'weight' => $result['weight'],
            'height' => $result['height'],
            'bmi' => round($result['bmi'], 2),
            'nutrition_status' => $result['nutritionStatus'],
            'recommendation' => $result['recommendation'],
        ]);

        return redirect()
            ->route('admin.nutrition.index')
            ->with('success', 'Perhitungan gizi berhasil disimpan.');
    }

    public function show($id)
    {
        $calculation = NutritionCalculation::with('child.user')
            ->findOrFail($id);

        $result = $this->calculateNutrition(
            $calculation->child_id,
            $calculation->calculation_date,
            $calculation->weight,
            $calculation->height
        );

        return view(
            'admin.nutrition.result',
            compact('calculation', 'result')
        );
    }

    public function edit($id)
    {
        $calculation = NutritionCalculation::findOrFail($id);

        $children = Child::with('user')
            ->orderBy('name', 'asc')
            ->get();

        return view(
            'admin.nutrition.edit',
            compact('calculation', 'children')
        );
    }

    public function update(Request $request, $id)
    {
        $calculation = NutritionCalculation::findOrFail($id);

        $request->validate([
            'child_id' => 'required|exists:children,id',
            'calculation_date' => 'required|date',
            'weight' => 'required|numeric|min:0.1',
            'height' => 'required|numeric|min:1',
        ], [
            'child_id.required' => 'Anak wajib dipilih.',
            'child_id.exists' => 'Data anak tidak ditemukan.',
            'calculation_date.required' => 'Tanggal perhitungan wajib diisi.',
            'calculation_date.date' => 'Tanggal perhitungan tidak valid.',
            'weight.required' => 'Berat badan wajib diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'height.required' => 'Tinggi badan wajib diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
        ]);

        $result = $this->calculateNutrition(
            $request->child_id,
            $request->calculation_date,
            $request->weight,
            $request->height
        );

        $calculation->update([
            'child_id' => $result['child']->id,
            'calculation_date' => $request->calculation_date,
            'age_in_months' => $result['ageInMonths'],
            'weight' => $result['weight'],
            'height' => $result['height'],
            'bmi' => round($result['bmi'], 2),
            'nutrition_status' => $result['nutritionStatus'],
            'recommendation' => $result['recommendation'],
        ]);

        return redirect()
            ->route('admin.nutrition.index')
            ->with('success', 'Perhitungan gizi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $calculation = NutritionCalculation::findOrFail($id);

        $calculation->delete();

        return redirect()
            ->route('admin.nutrition.index')
            ->with('success', 'Data perhitungan gizi berhasil dihapus.');
    }

    private function calculateNutrition(
        $childId,
        $calculationDate,
        $weight,
        $height
    ) {
        $child = Child::findOrFail($childId);

        $calculationDate = Carbon::parse($calculationDate);
        $birthDate = Carbon::parse($child->birth_date);

        $ageInMonths = $birthDate->diffInMonths($calculationDate);

        if ($child->gender === 'L') {
            $gender = 'male';
        } else {
            $gender = 'female';
        }

        $weight = (float) $weight;
        $height = (float) $height;

        $heightMeter = $height / 100;

        $bmi = $weight / ($heightMeter * $heightMeter);

        /*
         * BB/U
         */

        $weightStandard = GrowthStandard::where('gender', $gender)
            ->where('index_type', 'wfa')
            ->where('age_month', $ageInMonths)
            ->first();

        $weightZScore = null;
        $weightStatus = 'Data standar tidak tersedia';

        if ($weightStandard) {
            $weightZScore = $this->calculateZScore(
                $weight,
                $weightStandard
            );

            $weightStatus = $this->statusWeightForAge(
                $weightZScore
            );
        }

        /*
         * PB/U atau TB/U
         */

        if ($ageInMonths < 24) {
            $heightIndex = 'lfa';
            $heightLabel = 'PB/U';
        } else {
            $heightIndex = 'hfa';
            $heightLabel = 'TB/U';
        }

        $heightStandard = GrowthStandard::where('gender', $gender)
            ->where('index_type', $heightIndex)
            ->where('age_month', $ageInMonths)
            ->first();

        $heightZScore = null;
        $heightStatus = 'Data standar tidak tersedia';

        if ($heightStandard) {
            $heightZScore = $this->calculateZScore(
                $height,
                $heightStandard
            );

            $heightStatus = $this->statusHeightForAge(
                $heightZScore
            );
        }

        /*
         * BB/PB atau BB/TB
         */

        if ($ageInMonths < 24) {
            $weightHeightIndex = 'wfl';
            $weightHeightLabel = 'BB/PB';
        } else {
            $weightHeightIndex = 'wfh';
            $weightHeightLabel = 'BB/TB';
        }

        $weightHeightStandard = $this->findClosestHeightStandard(
            $gender,
            $weightHeightIndex,
            $height
        );

        $weightHeightZScore = null;
        $weightHeightStatus = 'Data standar tidak tersedia';

        if ($weightHeightStandard) {
            $weightHeightZScore = $this->calculateZScore(
                $weight,
                $weightHeightStandard
            );

            $weightHeightStatus = $this->statusWeightForHeight(
                $weightHeightZScore
            );
        }

        /*
         * IMT/U
         */

        $bmiStandard = GrowthStandard::where('gender', $gender)
            ->where('index_type', 'bmiu')
            ->where('age_month', $ageInMonths)
            ->first();

        $bmiZScore = null;
        $bmiStatus = 'Data standar tidak tersedia';

        if ($bmiStandard) {
            $bmiZScore = $this->calculateZScore(
                $bmi,
                $bmiStandard
            );

            $bmiStatus = $this->statusBmiForAge(
                $bmiZScore,
                $ageInMonths
            );
        }

        /*
         * Kesimpulan
         */

        $nutritionStatus =
            'BB/U: ' . $weightStatus .
            ' | ' . $heightLabel . ': ' . $heightStatus .
            ' | ' . $weightHeightLabel . ': ' . $weightHeightStatus .
            ' | IMT/U: ' . $bmiStatus;

        /*
         * Rekomendasi
         */

        $recommendation = $this->makeRecommendation(
            $weightStatus,
            $heightStatus,
            $weightHeightStatus,
            $bmiStatus
        );

        return [
            'child' => $child,
            'ageInMonths' => $ageInMonths,

            'weight' => $weight,
            'height' => $height,

            'bmi' => $bmi,

            'gender' => $gender,

            'weightZScore' => $weightZScore,
            'weightStatus' => $weightStatus,

            'heightZScore' => $heightZScore,
            'heightStatus' => $heightStatus,
            'heightLabel' => $heightLabel,

            'weightHeightZScore' => $weightHeightZScore,
            'weightHeightStatus' => $weightHeightStatus,
            'weightHeightLabel' => $weightHeightLabel,

            'bmiZScore' => $bmiZScore,
            'bmiStatus' => $bmiStatus,

            'nutritionStatus' => $nutritionStatus,
            'recommendation' => $recommendation,
        ];
    }

    private function calculateZScore(
        float $value,
        GrowthStandard $standard
    ): float {
        $points = [
            -3 => (float) $standard->sd_minus_3,
            -2 => (float) $standard->sd_minus_2,
            -1 => (float) $standard->sd_minus_1,
             0 => (float) $standard->median,
             1 => (float) $standard->sd_plus_1,
             2 => (float) $standard->sd_plus_2,
             3 => (float) $standard->sd_plus_3,
        ];

        foreach ($points as $z => $standardValue) {
            if ($value == $standardValue) {
                return (float) $z;
            }
        }

        $keys = array_keys($points);

        for ($i = 0; $i < count($keys) - 1; $i++) {

            $z1 = $keys[$i];
            $z2 = $keys[$i + 1];

            $v1 = $points[$z1];
            $v2 = $points[$z2];

            if ($value >= $v1 && $value <= $v2) {

                if ($v2 == $v1) {
                    return (float) $z1;
                }

                $zScore = $z1 +
                    (($value - $v1) / ($v2 - $v1))
                    * ($z2 - $z1);

                return round($zScore, 2);
            }
        }

        if ($value < $points[-3]) {
            return -3;
        }

        if ($value > $points[3]) {
            return 3;
        }

        return 0;
    }

    private function findClosestHeightStandard(
        string $gender,
        string $indexType,
        float $height
    ) {
        return GrowthStandard::where('gender', $gender)
            ->where('index_type', $indexType)
            ->whereNotNull('measurement_value')
            ->orderByRaw(
                'ABS(measurement_value - ?)',
                [$height]
            )
            ->first();
    }

    private function statusWeightForAge(
        float $zScore
    ): string {
        if ($zScore < -3) {
            return 'Berat badan sangat kurang';
        }

        if ($zScore < -2) {
            return 'Berat badan kurang';
        }

        if ($zScore <= 1) {
            return 'Berat badan normal';
        }

        return 'Risiko berat badan lebih';
    }

    private function statusHeightForAge(
        float $zScore
    ): string {
        if ($zScore < -3) {
            return 'Sangat pendek';
        }

        if ($zScore < -2) {
            return 'Pendek';
        }

        if ($zScore <= 3) {
            return 'Normal';
        }

        return 'Tinggi';
    }

    private function statusWeightForHeight(
        float $zScore
    ): string {
        if ($zScore < -3) {
            return 'Gizi buruk';
        }

        if ($zScore < -2) {
            return 'Gizi kurang';
        }

        if ($zScore <= 1) {
            return 'Gizi baik';
        }

        if ($zScore <= 2) {
            return 'Berisiko gizi lebih';
        }

        if ($zScore <= 3) {
            return 'Gizi lebih';
        }

        return 'Obesitas';
    }

    private function statusBmiForAge(
        float $zScore,
        int $ageInMonths
    ): string {
        if ($ageInMonths <= 60) {

            if ($zScore < -3) {
                return 'Gizi buruk';
            }

            if ($zScore < -2) {
                return 'Gizi kurang';
            }

            if ($zScore <= 1) {
                return 'Gizi baik';
            }

            if ($zScore <= 2) {
                return 'Berisiko gizi lebih';
            }

            if ($zScore <= 3) {
                return 'Gizi lebih';
            }

            return 'Obesitas';
        }

        if ($zScore < -3) {
            return 'Gizi buruk';
        }

        if ($zScore < -2) {
            return 'Gizi kurang';
        }

        if ($zScore <= 1) {
            return 'Gizi baik';
        }

        if ($zScore <= 2) {
            return 'Gizi lebih';
        }

        return 'Obesitas';
    }

    private function makeRecommendation(
        string $weightStatus,
        string $heightStatus,
        string $weightHeightStatus,
        string $bmiStatus
    ): string {
        $recommendations = [];

        if (
            $weightStatus === 'Berat badan sangat kurang' ||
            $weightStatus === 'Berat badan kurang'
        ) {
            $recommendations[] =
                'Perlu perhatian pada berat badan anak dan pemantauan pertumbuhan secara berkala.';
        }

        if (
            $heightStatus === 'Sangat pendek' ||
            $heightStatus === 'Pendek'
        ) {
            $recommendations[] =
                'Pertumbuhan tinggi badan perlu dipantau dan dikonfirmasi oleh tenaga kesehatan.';
        }

        if (
            $weightHeightStatus === 'Gizi buruk' ||
            $weightHeightStatus === 'Gizi kurang'
        ) {
            $recommendations[] =
                'Perlu evaluasi status gizi lebih lanjut dan tindak lanjut oleh tenaga kesehatan.';
        }

        if (
            $weightHeightStatus === 'Berisiko gizi lebih' ||
            $weightHeightStatus === 'Gizi lebih' ||
            $weightHeightStatus === 'Obesitas'
        ) {
            $recommendations[] =
                'Perlu pemantauan pola makan, aktivitas fisik, dan pertumbuhan anak.';
        }

        if (
            $bmiStatus === 'Gizi buruk' ||
            $bmiStatus === 'Gizi kurang'
        ) {
            $recommendations[] =
                'Hasil IMT/U menunjukkan perlunya perhatian terhadap status gizi anak.';
        }

        if (
            $bmiStatus === 'Berisiko gizi lebih' ||
            $bmiStatus === 'Gizi lebih' ||
            $bmiStatus === 'Obesitas'
        ) {
            $recommendations[] =
                'Perlu perhatian terhadap risiko gizi lebih dan pemantauan pertumbuhan anak.';
        }

        if (empty($recommendations)) {
            return 'Hasil pengukuran berada dalam kategori yang perlu dipantau sesuai standar antropometri.';
        }

        return implode(' ', $recommendations);
    }
}