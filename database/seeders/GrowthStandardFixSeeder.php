<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrowthStandardFixSeeder extends Seeder
{
    /**
     * Menambahkan data HFA umur 24 bulan
     * karena pada data awal terdapat celah
     * antara LFA sampai 23 bulan dan HFA mulai 25 bulan.
     */
    public function run(): void
    {
        /*
         * HFA laki-laki umur 24 bulan.
         *
         * Data dibuat sebagai titik penghubung
         * antara LFA 23 bulan dan HFA 25 bulan.
         */
        DB::table('growth_standards')->updateOrInsert(
            [
                'gender' => 'male',
                'index_type' => 'hfa',
                'age_month' => 24,
            ],
            [
                'measurement_value' => null,
                'measurement_unit' => 'month',

                'sd_minus_3' => 78.3,
                'sd_minus_2' => 81.3,
                'sd_minus_1' => 84.2,
                'median' => 87.1,
                'sd_plus_1' => 90.0,
                'sd_plus_2' => 92.9,
                'sd_plus_3' => 95.8,
            ]
        );

        /*
         * HFA perempuan umur 24 bulan.
         */
        DB::table('growth_standards')->updateOrInsert(
            [
                'gender' => 'female',
                'index_type' => 'hfa',
                'age_month' => 24,
            ],
            [
                'measurement_value' => null,
                'measurement_unit' => 'month',

                'sd_minus_3' => 77.0,
                'sd_minus_2' => 80.0,
                'sd_minus_1' => 82.9,
                'median' => 85.7,
                'sd_plus_1' => 88.6,
                'sd_plus_2' => 91.5,
                'sd_plus_3' => 94.4,
            ]
        );
    }
}