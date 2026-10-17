<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\GrowthStandard;
use App\Models\NutritionCalculation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NutritionController extends Controller
{
    public function create()
    {
        $children = Child::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('user.nutrition.create', compact('children'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|integer',
            'calculation_date' => 'required|date',
        ]);

        $child = Child::where('id', $validated['child_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $calculationDate = Carbon::parse(
            $validated['calculation_date']
        );

        $birthDate = Carbon::parse(
            $child->birth_date
        );

        if ($calculationDate->lt($birthDate)) {
            return back()
                ->withErrors([
                    'calculation_date' =>
                        'Tanggal pemeriksaan tidak boleh sebelum tanggal lahir anak.',
                ])
                ->withInput();
        }

        $ageInMonths = (int) floor(
            $birthDate->diffInMonths($calculationDate)
        );

        if ($ageInMonths > 216) {
            return back()
                ->withErrors([
                    'calculation_date' =>
                        'Perhitungan hanya tersedia untuk anak usia 0–18 tahun.',
                ])
                ->withInput();
        }

        $result = $this->calculateNutrition(
            $child,
            $calculationDate,
            $ageInMonths
        );

        $calculation = new NutritionCalculation();

        $calculation->forceFill([
            'child_id' => $child->id,

            'calculation_date' =>
                $calculationDate->toDateString(),

            'age' =>
                $ageInMonths,

            'age_in_months' =>
                $ageInMonths,

            'weight' =>
                $child->weight,

            'height' =>
                $child->height,

            'bmi' =>
                $result['bmi'],

            'ideal_weight' =>
                $result['ideal_weight'],

            'height_age_months' =>
                $result['height_age_months'],

            'energy_per_kg' =>
                $result['energy_per_kg'],

            'energy_requirement' =>
                $result['energy_requirement'],

            'solid_percentage' =>
                $result['solid_percentage'],

            'liquid_percentage' =>
                $result['liquid_percentage'],

            'solid_energy' =>
                $result['solid_energy'],

            'liquid_energy' =>
                $result['liquid_energy'],

            'liquid_ml' =>
                $result['liquid_ml'],

            'protein_requirement' =>
                $result['protein_requirement'],

            'fat_requirement' =>
                $result['fat_requirement'],

            'carbohydrate_requirement' =>
                $result['carbohydrate_requirement'],

            'food_quantitative' =>
                $result['food_quantitative'],

            'nutrition_status' =>
                $result['nutrition_status'],

            'recommendation' =>
                $result['recommendation'],

            'energy' =>
                $result['energy_requirement'] ?? 0,

            'protein' =>
                $result['protein_requirement'] ?? 0,

            'fat' =>
                $result['fat_requirement'] ?? 0,

            'carbohydrate' =>
                $result['carbohydrate_requirement'] ?? 0,
        ]);

        $calculation->save();

        return view('user.nutrition.result', [
            'calculation' => $calculation,
            'child' => $child,
            'result' => $result,
            'calculationDate' => $calculationDate,
        ]);
    }

    private function calculateNutrition(
        Child $child,
        Carbon $calculationDate,
        int $ageInMonths
    ): array {
        $gender = $this->normalizeGender(
            $child->gender
        );

        $weight = (float) $child->weight;
        $height = (float) $child->height;

        /*
         * Metode pengukuran:
         * recumbent = terlentang
         * standing  = berdiri
         */
        $measurementMethod =
            $child->measurement_method ?? 'standing';

        /*
         * Tinggi/panjang yang digunakan
         * untuk penilaian antropometri.
         *
         * Aturan:
         * 0-24 bulan:
         * - terlentang = tetap
         * - berdiri = +0.7 cm
         *
         * >24 bulan:
         * - berdiri = tetap
         * - terlentang = -0.7 cm
         */
        $heightForAssessment =
            $this->adjustHeight(
                $height,
                $ageInMonths,
                $measurementMethod
            );

        /*
         * BMI / IMT
         */
        $bmi = $this->calculateBmi(
            $weight,
            $heightForAssessment
        );

        /*
         * Status gizi
         */
        $statuses = [
            'BB/U' => null,
            'TB/U' => null,
            'BB/TB' => null,
            'IMT/U' => null,
        ];

        $zScores = [];

        /*
         * BB/U
         *
         * Tidak menggunakan tinggi badan.
         * Hanya berat badan dan umur.
         */
        if ($ageInMonths <= 60) {
            $wfa = GrowthStandard::where(
                'index_type',
                'wfa'
            )
                ->where('gender', $gender)
                ->where('age_month', $ageInMonths)
                ->first();

            if ($wfa) {
                $z = $this->calculateZScore(
                    $weight,
                    $wfa
                );

                $zScores['wfa'] = $z;

                $statuses['BB/U'] =
                    $this->interpretWeightForAge($z);
            }
        }

        /*
         * TB/U atau PB/U
         *
         * 0-24 bulan  -> LFA
         * >24-60 bulan -> HFA
         *
         * Tinggi/panjang sudah dikoreksi
         * berdasarkan metode pengukuran.
         */
        $heightStandard = null;

        if ($ageInMonths <= 24) {
            $heightStandard = GrowthStandard::where(
                'index_type',
                'lfa'
            )
                ->where('gender', $gender)
                ->where('age_month', $ageInMonths)
                ->first();
        } elseif ($ageInMonths <= 60) {
            $heightStandard = GrowthStandard::where(
                'index_type',
                'hfa'
            )
                ->where('gender', $gender)
                ->where('age_month', $ageInMonths)
                ->first();
        }

        if ($heightStandard) {
            $z = $this->calculateZScore(
                $heightForAssessment,
                $heightStandard
            );

            $zScores['height_age'] = $z;

            $statuses['TB/U'] =
                $this->interpretHeightForAge($z);
        }

        /*
         * BB/TB atau BB/PB
         *
         * Tinggi/panjang yang digunakan
         * adalah tinggi yang sudah dikoreksi.
         */
        $wfhStandard = GrowthStandard::where(
            'index_type',
            'wfh'
        )
            ->where('gender', $gender)
            ->whereNotNull('measurement_value')
            ->orderByRaw(
                'ABS(measurement_value - ?)',
                [$heightForAssessment]
            )
            ->first();

        if ($wfhStandard) {
            $z = $this->calculateZScore(
                $weight,
                $wfhStandard
            );

            $zScores['weight_height'] = $z;

            $statuses['BB/TB'] =
                $this->interpretWeightForHeight($z);
        }

        /*
         * IMT/U
         *
         * BMI menggunakan tinggi/panjang
         * yang sudah dikoreksi.
         */
        $bmiStandard = GrowthStandard::where(
            'index_type',
            'bmiu'
        )
            ->where('gender', $gender)
            ->where('age_month', $ageInMonths)
            ->first();

        if ($bmiStandard) {
            $z = $this->calculateZScore(
                $bmi,
                $bmiStandard
            );

            $zScores['bmi_age'] = $z;

            if ($ageInMonths <= 60) {
                $statuses['IMT/U'] =
                    $this->interpretBmiUnderFive($z);
            } else {
                $statuses['IMT/U'] =
                    $this->interpretBmiFiveToEighteen($z);
            }
        }

        /*
         * Gabungkan status gizi
         */
        $nutritionStatusParts = [];

        foreach ($statuses as $index => $status) {
            if ($status !== null) {
                $nutritionStatusParts[] =
                    $index . ': ' . $status;
            }
        }

        if (!empty($nutritionStatusParts)) {
            $nutritionStatus =
                implode(
                    ' | ',
                    $nutritionStatusParts
                );
        } else {
            $nutritionStatus =
                'Data status gizi belum tersedia';
        }

        /*
         * Height age
         */
        $heightAgeMonths =
            $this->findHeightAge(
                $gender,
                $heightForAssessment
            );

        /*
         * Berat badan ideal
         */
        $idealWeight = null;

        if (
            $ageInMonths <= 60 &&
            $heightAgeMonths !== null
        ) {
            $idealWeightStandard =
                GrowthStandard::where(
                    'index_type',
                    'wfa'
                )
                    ->where('gender', $gender)
                    ->where(
                        'age_month',
                        $heightAgeMonths
                    )
                    ->first();

            if ($idealWeightStandard) {
                $idealWeight =
                    (float) $idealWeightStandard->median;
            }
        }

        /*
         * Fallback menggunakan BB/TB
         */
        if ($idealWeight === null) {
            $idealWeightStandard =
                GrowthStandard::where(
                    'index_type',
                    'wfh'
                )
                    ->where('gender', $gender)
                    ->whereNotNull('measurement_value')
                    ->orderByRaw(
                        'ABS(measurement_value - ?)',
                        [$heightForAssessment]
                    )
                    ->first();

            if ($idealWeightStandard) {
                $idealWeight =
                    (float) $idealWeightStandard->median;
            }
        }

        $energyWeight =
            $idealWeight !== null
                ? $idealWeight
                : $weight;

        /*
         * Kebutuhan energi
         */
        $energyPerKg =
            $this->getEnergyPerKg(
                $ageInMonths,
                $gender
            );

        $energyRequirement = null;

        if ($energyPerKg !== null) {
            $energyRequirement = round(
                $energyWeight *
                    $energyPerKg,
                2
            );
        }

        /*
         * Pembagian makanan
         */
        $solidPercentage = 0;
        $liquidPercentage = 0;

        if ($ageInMonths <= 6) {
            $solidPercentage = 0;
            $liquidPercentage = 100;
        } elseif ($ageInMonths <= 8) {
            $solidPercentage = 30;
            $liquidPercentage = 70;
        } elseif ($ageInMonths <= 12) {
            $solidPercentage = 50;
            $liquidPercentage = 50;
        } else {
            $solidPercentage = 70;
            $liquidPercentage = 30;
        }

        $solidEnergy = null;
        $liquidEnergy = null;
        $liquidMl = null;

        if ($energyRequirement !== null) {
            $solidEnergy = round(
                $energyRequirement *
                    ($solidPercentage / 100),
                2
            );

            $liquidEnergy = round(
                $energyRequirement *
                    ($liquidPercentage / 100),
                2
            );

            if ($liquidPercentage > 0) {
                $liquidMl = round(
                    $liquidEnergy / 0.67,
                    2
                );
            }
        }

        /*
         * Zat gizi makro
         */
        $proteinRequirement = null;
        $fatRequirement = null;
        $carbohydrateRequirement = null;

        if ($energyRequirement !== null) {
            $proteinEnergy =
                $energyRequirement * 0.12;

            $fatEnergy =
                $energyRequirement * 0.30;

            $carbohydrateEnergy =
                $energyRequirement * 0.58;

            $proteinRequirement = round(
                $proteinEnergy / 4,
                2
            );

            $fatRequirement = round(
                $fatEnergy / 9,
                2
            );

            $carbohydrateRequirement = round(
                $carbohydrateEnergy / 4,
                2
            );
        }

        /*
         * Food quantitative
         */
        $foodQuantitative = [
            'solid_food' => [
                'percentage' =>
                    $solidPercentage,

                'energy_kcal' =>
                    $solidEnergy,
            ],

            'liquid_food' => [
                'percentage' =>
                    $liquidPercentage,

                'energy_kcal' =>
                    $liquidEnergy,

                'volume_ml' =>
                    $liquidMl,

                'energy_density_kcal_per_ml' =>
                    0.67,
            ],

            'description' =>
                $this->foodQuantityDescription(
                    $ageInMonths
                ),
        ];

        /*
         * Rekomendasi
         */
        $recommendation =
            $this->makeRecommendation(
                $nutritionStatus,
                $ageInMonths,
                $idealWeight,
                $energyRequirement
            );

        return [
            'age_in_months' =>
                $ageInMonths,

            'age_years' =>
                intdiv(
                    $ageInMonths,
                    12
                ),

            'age_remaining_months' =>
                $ageInMonths % 12,

            'age_text' =>
                $this->formatAge(
                    intdiv(
                        $ageInMonths,
                        12
                    ),
                    $ageInMonths % 12
                ),

            'weight' =>
                $weight,

            'height' =>
                $height,

            'measurement_method' =>
                $measurementMethod,

            'height_for_assessment' =>
                $heightForAssessment,

            'bmi' =>
                $bmi,

            'nutrition_status' =>
                $nutritionStatus,

            'recommendation' =>
                $recommendation,

            'statuses' =>
                $statuses,

            'z_scores' =>
                $zScores,

            'ideal_weight' =>
                $idealWeight,

            'height_age_months' =>
                $heightAgeMonths,

            'energy_per_kg' =>
                $energyPerKg,

            'energy_requirement' =>
                $energyRequirement,

            'solid_percentage' =>
                $solidPercentage,

            'liquid_percentage' =>
                $liquidPercentage,

            'solid_energy' =>
                $solidEnergy,

            'liquid_energy' =>
                $liquidEnergy,

            'liquid_ml' =>
                $liquidMl,

            'protein_requirement' =>
                $proteinRequirement,

            'fat_requirement' =>
                $fatRequirement,

            'carbohydrate_requirement' =>
                $carbohydrateRequirement,

            'food_quantitative' =>
                $foodQuantitative,
        ];
    }

    private function adjustHeight(
        float $height,
        int $ageInMonths,
        string $measurementMethod
    ): float {
        $measurementMethod =
            strtolower(
                trim($measurementMethod)
            );

        /*
         * Anak 0-24 bulan:
         * standar menggunakan panjang badan
         * dalam posisi terlentang.
         */
        if ($ageInMonths <= 24) {
            if ($measurementMethod === 'standing') {
                return round(
                    $height + 0.7,
                    2
                );
            }

            return round(
                $height,
                2
            );
        }

        /*
         * Anak di atas 24 bulan:
         * standar menggunakan tinggi badan
         * dalam posisi berdiri.
         */
        if ($measurementMethod === 'recumbent') {
            return round(
                $height - 0.7,
                2
            );
        }

        return round(
            $height,
            2
        );
    }

    private function findHeightAge(
        string $gender,
        float $height
    ): ?int {
        $standards = GrowthStandard::where(
            'index_type',
            'hfa'
        )
            ->where('gender', $gender)
            ->whereNotNull('median')
            ->orderBy('age_month')
            ->get();

        if ($standards->isEmpty()) {
            $standards = GrowthStandard::where(
                'index_type',
                'lfa'
            )
                ->where('gender', $gender)
                ->whereNotNull('median')
                ->orderBy('age_month')
                ->get();
        }

        if ($standards->isEmpty()) {
            return null;
        }

        $closest = null;
        $smallestDifference = null;

        foreach ($standards as $standard) {
            $median =
                (float) $standard->median;

            $difference =
                abs(
                    $height - $median
                );

            if (
                $smallestDifference === null ||
                $difference < $smallestDifference
            ) {
                $smallestDifference =
                    $difference;

                $closest =
                    $standard;
            }
        }

        if (!$closest) {
            return null;
        }

        return (int) $closest->age_month;
    }

    private function getEnergyPerKg(
        int $ageInMonths,
        string $gender
    ): ?float {
        if ($ageInMonths <= 6) {
            return 120;
        }

        if ($ageInMonths <= 12) {
            return 110;
        }

        if ($ageInMonths <= 36) {
            return 100;
        }

        if ($ageInMonths <= 72) {
            return 90;
        }

        if ($ageInMonths <= 108) {
            return 80;
        }

        if ($ageInMonths <= 144) {
            return $gender === 'male'
                ? 65
                : 55;
        }

        if ($ageInMonths <= 216) {
            return $gender === 'male'
                ? 55
                : 45;
        }

        return null;
    }

    private function calculateBmi(
        float $weight,
        float $height
    ): float {
        if ($height <= 0) {
            return 0;
        }

        $heightMeter =
            $height / 100;

        return round(
            $weight /
                ($heightMeter * $heightMeter),
            2
        );
    }

    private function normalizeGender(
        ?string $gender
    ): string {
        $gender =
            strtolower(
                trim(
                    (string) $gender
                )
            );

        if (
            in_array(
                $gender,
                [
                    'l',
                    'laki-laki',
                    'male',
                    'm',
                ],
                true
            )
        ) {
            return 'male';
        }

        return 'female';
    }

    private function formatAge(
        int $years,
        int $months
    ): string {
        return $years .
            ' tahun ' .
            $months .
            ' bulan';
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

        /*
         * Pastikan data standar lengkap.
         */
        foreach ($points as $z => $measurement) {
            if ($measurement <= 0) {
                unset($points[$z]);
            }
        }

        if (count($points) < 2) {
            return 0;
        }

        $keys = array_keys($points);

        /*
         * Nilai berada di bawah -3 SD.
         */
        if ($value <= $points[$keys[0]]) {
            $z1 = $keys[0];
            $z2 = $keys[1];

            return round(
                $this->interpolateZScore(
                    $value,
                    $points[$z1],
                    $points[$z2],
                    $z1,
                    $z2
                ),
                2
            );
        }

        /*
         * Nilai berada di atas +3 SD.
         */
        $last = count($keys) - 1;

        if ($value >= $points[$keys[$last]]) {
            $z1 = $keys[$last - 1];
            $z2 = $keys[$last];

            return round(
                $this->interpolateZScore(
                    $value,
                    $points[$z1],
                    $points[$z2],
                    $z1,
                    $z2
                ),
                2
            );
        }

        /*
         * Cari interval SD yang sesuai.
         */
        for ($i = 0; $i < count($keys) - 1; $i++) {
            $z1 = $keys[$i];
            $z2 = $keys[$i + 1];

            $v1 = $points[$z1];
            $v2 = $points[$z2];

            if (
                $value >= $v1 &&
                $value <= $v2
            ) {
                return round(
                    $this->interpolateZScore(
                        $value,
                        $v1,
                        $v2,
                        $z1,
                        $z2
                    ),
                    2
                );
            }
        }

        return 0;
    }

    private function interpolateZScore(
        float $value,
        float $value1,
        float $value2,
        int $z1,
        int $z2
    ): float {
        if ($value2 == $value1) {
            return (float) $z1;
        }

        return $z1 +
            (
                ($value - $value1) /
                ($value2 - $value1)
            ) *
            ($z2 - $z1);
    }

    private function interpretWeightForAge(
        float $z
    ): string {
        if ($z < -3) {
            return 'Berat badan sangat kurang';
        }

        if ($z < -2) {
            return 'Berat badan kurang';
        }

        if ($z <= 1) {
            return 'Normal';
        }

        return 'Risiko berat badan lebih';
    }

    private function interpretHeightForAge(
        float $z
    ): string {
        if ($z < -3) {
            return 'Sangat pendek';
        }

        if ($z < -2) {
            return 'Pendek';
        }

        if ($z <= 3) {
            return 'Normal';
        }

        return 'Tinggi';
    }

    private function interpretWeightForHeight(
        float $z
    ): string {
        if ($z < -3) {
            return 'Gizi buruk';
        }

        if ($z < -2) {
            return 'Gizi kurang';
        }

        if ($z <= 1) {
            return 'Gizi baik';
        }

        if ($z <= 2) {
            return 'Berisiko gizi lebih';
        }

        if ($z <= 3) {
            return 'Gizi lebih';
        }

        return 'Obesitas';
    }

    private function interpretBmiUnderFive(
        float $z
    ): string {
        if ($z < -3) {
            return 'Gizi buruk';
        }

        if ($z < -2) {
            return 'Gizi kurang';
        }

        if ($z <= 1) {
            return 'Gizi baik';
        }

        if ($z <= 2) {
            return 'Berisiko gizi lebih';
        }

        if ($z <= 3) {
            return 'Gizi lebih';
        }

        return 'Obesitas';
    }

    private function interpretBmiFiveToEighteen(
        float $z
    ): string {
        if ($z < -3) {
            return 'Gizi buruk';
        }

        if ($z < -2) {
            return 'Gizi kurang';
        }

        if ($z <= 1) {
            return 'Gizi baik';
        }

        if ($z <= 2) {
            return 'Gizi lebih';
        }

        return 'Obesitas';
    }

    private function foodQuantityDescription(
        int $ageInMonths
    ): string {
        if ($ageInMonths <= 6) {
            return 'Seluruh kebutuhan energi berasal dari liquid food/ASI.';
        }

        if ($ageInMonths <= 8) {
            return 'Sekitar 30% kebutuhan energi berasal dari makanan padat dan 70% dari liquid food/ASI.';
        }

        if ($ageInMonths <= 12) {
            return 'Sekitar 50% kebutuhan energi berasal dari makanan padat dan 50% dari liquid food/ASI.';
        }

        return 'Sekitar 70% kebutuhan energi berasal dari makanan padat dan 30% dari liquid food/ASI.';
    }

    private function makeRecommendation(
        string $nutritionStatus,
        int $ageInMonths,
        ?float $idealWeight,
        ?float $energyRequirement
    ): string {
        $recommendation =
            'Perlu pemantauan pola makan, aktivitas fisik, dan pertumbuhan anak secara berkala.';

        if (
            str_contains(
                $nutritionStatus,
                'Gizi buruk'
            ) ||
            str_contains(
                $nutritionStatus,
                'Sangat kurus'
            )
        ) {
            $recommendation =
                'Perhatikan kecukupan energi dan zat gizi anak serta lakukan pemantauan pertumbuhan secara berkala.';
        } elseif (
            str_contains(
                $nutritionStatus,
                'Gizi kurang'
            ) ||
            str_contains(
                $nutritionStatus,
                'Kurus'
            )
        ) {
            $recommendation =
                'Tingkatkan kualitas dan kecukupan asupan makanan anak dan pantau pertumbuhan secara berkala.';
        } elseif (
            str_contains(
                $nutritionStatus,
                'Gizi lebih'
            ) ||
            str_contains(
                $nutritionStatus,
                'Obesitas'
            ) ||
            str_contains(
                $nutritionStatus,
                'Gemuk'
            )
        ) {
            $recommendation =
                'Perhatikan pola makan seimbang dan aktivitas fisik anak serta batasi makanan tinggi gula, garam, dan lemak.';
        } elseif (
            str_contains(
                $nutritionStatus,
                'Normal'
            ) ||
            str_contains(
                $nutritionStatus,
                'Gizi baik'
            )
        ) {
            $recommendation =
                'Pertahankan pola makan bergizi seimbang dan pantau pertumbuhan anak secara berkala.';
        }

        return $recommendation;
    }
}
