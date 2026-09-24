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
    /**
     * Menampilkan halaman form perhitungan nutrisi.
     */
    public function create()
    {
        $children = Child::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('user.nutrition.create', compact('children'));
    }

    /**
     * Menyimpan hasil perhitungan nutrisi.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|integer',
            'calculation_date' => 'required|date',
        ]);

        // Pastikan anak milik user yang sedang login.
        $child = Child::where('id', $validated['child_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $calculationDate = Carbon::parse(
            $validated['calculation_date']
        );

        $birthDate = Carbon::parse(
            $child->birth_date
        );

        // Tanggal pemeriksaan tidak boleh sebelum tanggal lahir.
        if ($calculationDate->lt($birthDate)) {
            return back()
                ->withErrors([
                    'calculation_date' =>
                        'Tanggal pemeriksaan tidak boleh sebelum tanggal lahir anak.',
                ])
                ->withInput();
        }

        // Hitung umur dalam bulan penuh.
        $ageInMonths = (int) floor(
            $birthDate->diffInMonths($calculationDate)
        );

        // Maksimal 18 tahun.
        if ($ageInMonths > 216) {
            return back()
                ->withErrors([
                    'calculation_date' =>
                        'Perhitungan hanya tersedia untuk anak usia 0–18 tahun.',
                ])
                ->withInput();
        }

        // Hitung seluruh data nutrisi.
        $result = $this->calculateNutrition(
            $child,
            $calculationDate,
            $ageInMonths
        );

        // Simpan hasil ke database.
        $calculation = NutritionCalculation::create([
            'child_id' => $child->id,
            'calculation_date' => $calculationDate->toDateString(),

            'age_in_months' => $ageInMonths,
            'weight' => $child->weight,
            'height' => $child->height,
            'bmi' => $result['bmi'],

            'ideal_weight' => $result['ideal_weight'],
            'height_age_months' => $result['height_age_months'],
            'energy_per_kg' => $result['energy_per_kg'],
            'energy_requirement' => $result['energy_requirement'],

            'solid_percentage' => $result['solid_percentage'],
            'liquid_percentage' => $result['liquid_percentage'],
            'solid_energy' => $result['solid_energy'],
            'liquid_energy' => $result['liquid_energy'],
            'liquid_ml' => $result['liquid_ml'],

            'protein_requirement' => $result['protein_requirement'],
            'fat_requirement' => $result['fat_requirement'],
            'carbohydrate_requirement' => $result['carbohydrate_requirement'],

            'food_quantitative' => $result['food_quantitative'],

            'nutrition_status' => $result['nutrition_status'],
            'recommendation' => $result['recommendation'],
        ]);

        return view('user.nutrition.result', [
            'calculation' => $calculation,
            'child' => $child,
            'result' => $result,
            'calculationDate' => $calculationDate,
        ]);
    }

    /**
     * Menghitung semua data nutrisi.
     */
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

        // Hitung BMI.
        $bmi = $this->calculateBmi(
            $weight,
            $height
        );

        /*
         * =====================================================
         * STATUS GIZI
         * =====================================================
         *
         * Empat indikator:
         *
         * 1. BB/U
         * 2. TB/U
         * 3. BB/TB
         * 4. IMT/U
         *
         * Semua key dibuat dari awal supaya Blade selalu
         * mempunyai tempat untuk menampilkan keempat indikator.
         */
        $statuses = [
            'BB/U' => null,
            'TB/U' => null,
            'BB/TB' => null,
            'IMT/U' => null,
        ];

        $zScores = [];

        /*
         * =====================================================
         * 1. BB/U
         * =====================================================
         *
         * Standar WFA tersedia sampai 60 bulan.
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
                    $wfa->median,
                    $wfa
                );

                $zScores['wfa'] = $z;

                $statuses['BB/U'] =
                    $this->interpretWeightForAge($z);
            }
        }

        /*
         * =====================================================
         * 2. TB/U
         * =====================================================
         *
         * 0–23 bulan  = LFA
         * 24–60 bulan = HFA
         */
        $heightStandard = null;

        if ($ageInMonths <= 23) {
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
                $height,
                $heightStandard->median,
                $heightStandard
            );

            $zScores['height_age'] = $z;

            $statuses['TB/U'] =
                $this->interpretHeightForAge($z);
        }

        /*
         * =====================================================
         * 3. BB/TB
         * =====================================================
         *
         * WFH memakai measurement_value sebagai tinggi.
         */
        $wfhStandard = GrowthStandard::where(
            'index_type',
            'wfh'
        )
            ->where('gender', $gender)
            ->whereNotNull('measurement_value')
            ->orderByRaw(
                'ABS(measurement_value - ?)',
                [$height]
            )
            ->first();

        if ($wfhStandard) {
            $z = $this->calculateZScore(
                $weight,
                $wfhStandard->median,
                $wfhStandard
            );

            $zScores['weight_height'] = $z;

            $statuses['BB/TB'] =
                $this->interpretWeightForHeight($z);
        }

        /*
         * =====================================================
         * 4. IMT/U
         * =====================================================
         *
         * BMI menurut umur 0–18 tahun.
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
                $bmiStandard->median,
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
         * =====================================================
         * NUTRITION STATUS
         * =====================================================
         *
         * Hanya indikator yang benar-benar tersedia
         * yang dimasukkan ke string database.
         */
        $nutritionStatusParts = [];

        foreach ($statuses as $index => $status) {
            if ($status !== null) {
                $nutritionStatusParts[] =
                    $index . ': ' . $status;
            }
        }

        if (!empty($nutritionStatusParts)) {
            $nutritionStatus = implode(
                ' | ',
                $nutritionStatusParts
            );
        } else {
            $nutritionStatus =
                'Data status gizi belum tersedia';
        }

        /*
         * =====================================================
         * HEIGHT AGE
         * =====================================================
         */
        $heightAgeMonths =
            $this->findHeightAge(
                $gender,
                $height
            );

        /*
         * =====================================================
         * BB IDEAL
         * =====================================================
         */
        $idealWeight = null;

        // Gunakan WFA berdasarkan Height Age jika tersedia.
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

        // Fallback menggunakan WFH.
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
                        [$height]
                    )
                    ->first();

            if ($idealWeightStandard) {
                $idealWeight =
                    (float) $idealWeightStandard->median;
            }
        }

        // Berat yang dipakai untuk perhitungan energi.
        $energyWeight =
            $idealWeight !== null
                ? $idealWeight
                : $weight;

        /*
         * =====================================================
         * KEBUTUHAN ENERGI
         * =====================================================
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
         * =====================================================
         * FOOD QUANTITATIVE
         * =====================================================
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
         * =====================================================
         * ZAT GIZI MAKRO
         * =====================================================
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
         * =====================================================
         * DETAIL FOOD QUANTITATIVE
         * =====================================================
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
         * =====================================================
         * REKOMENDASI
         * =====================================================
         */
        $recommendation =
            $this->makeRecommendation(
                $nutritionStatus,
                $ageInMonths,
                $idealWeight,
                $energyRequirement
            );

        /*
         * =====================================================
         * HASIL AKHIR
         * =====================================================
         */
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

            'bmi' =>
                $bmi,

            'nutrition_status' =>
                $nutritionStatus,

            'recommendation' =>
                $recommendation,

            /*
             * PENTING:
             * Sekarang selalu ada 4 key.
             */
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

    /**
     * Mencari Height Age berdasarkan tinggi anak.
     */
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

    /**
     * Menentukan energi per kg.
     */
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

    /**
     * Menghitung BMI.
     */
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

    /**
     * Menormalisasi gender.
     */
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

    /**
     * Format umur.
     */
    private function formatAge(
        int $years,
        int $months
    ): string {
        return $years .
            ' tahun ' .
            $months .
            ' bulan';
    }

    /**
     * Menghitung Z-score pendekatan sederhana.
     */
    private function calculateZScore(
        float $value,
        $median,
        GrowthStandard $standard
    ): float {
        $median =
            (float) $median;

        $sdMinus1 =
            (float) $standard->sd_minus_1;

        $sdPlus1 =
            (float) $standard->sd_plus_1;

        $sd =
            (
                abs(
                    $median -
                    $sdMinus1
                ) +
                abs(
                    $sdPlus1 -
                    $median
                )
            ) / 2;

        if ($sd <= 0) {
            return 0;
        }

        return round(
            (
                $value -
                $median
            ) / $sd,
            2
        );
    }

    /**
     * Interpretasi BB/U.
     */
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

        return 'Berat badan lebih';
    }

    /**
     * Interpretasi TB/U.
     */
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

    /**
     * Interpretasi BB/TB.
     */
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
            return 'Risiko gizi lebih';
        }

        if ($z <= 3) {
            return 'Gizi lebih';
        }

        return 'Obesitas';
    }

    /**
     * Interpretasi IMT/U usia sampai 5 tahun.
     */
    private function interpretBmiUnderFive(
        float $z
    ): string {
        if ($z < -3) {
            return 'Sangat kurus';
        }

        if ($z < -2) {
            return 'Kurus';
        }

        if ($z <= 1) {
            return 'Normal';
        }

        if ($z <= 2) {
            return 'Berisiko gizi lebih';
        }

        if ($z <= 3) {
            return 'Gizi lebih';
        }

        return 'Obesitas';
    }

    /**
     * Interpretasi IMT/U usia 5–18 tahun.
     */
    private function interpretBmiFiveToEighteen(
        float $z
    ): string {
        if ($z < -3) {
            return 'Sangat kurus';
        }

        if ($z < -2) {
            return 'Kurus';
        }

        if ($z <= 1) {
            return 'Normal';
        }

        if ($z <= 2) {
            return 'Gemuk';
        }

        return 'Obesitas';
    }

    /**
     * Keterangan food quantitative.
     */
    private function foodQuantityDescription(
        int $ageInMonths
    ): string {
        if ($ageInMonths <= 6) {
            return
                'Seluruh kebutuhan energi berasal dari liquid food/ASI.';
        }

        if ($ageInMonths <= 8) {
            return
                'Sekitar 30% kebutuhan energi berasal dari makanan padat dan 70% dari liquid food/ASI.';
        }

        if ($ageInMonths <= 12) {
            return
                'Sekitar 50% kebutuhan energi berasal dari makanan padat dan 50% dari liquid food/ASI.';
        }

        return
            'Sekitar 70% kebutuhan energi berasal dari makanan padat dan 30% dari liquid food/ASI.';
    }

    /**
     * Membuat rekomendasi sederhana.
     */
    private function makeRecommendation(
        string $nutritionStatus,
        int $ageInMonths,
        ?float $idealWeight,
        ?float $energyRequirement
    ): string {
        $recommendation =
            'Perlu pemantauan pola makan, aktivitas fisik, dan pertumbuhan anak.';

        if (
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
            )
        ) {
            $recommendation =
                'Pertahankan pola makan bergizi seimbang dan pantau pertumbuhan anak secara berkala.';
        }

        return $recommendation;
    }
}