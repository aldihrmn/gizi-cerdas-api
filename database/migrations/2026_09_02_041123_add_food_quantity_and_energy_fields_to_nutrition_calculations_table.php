<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom yang belum ada.
     *
     * Kita menggunakan Schema::hasColumn()
     * supaya migration tidak error jika kolom
     * tersebut ternyata sudah tersedia di database.
     */
    public function up(): void
    {
        Schema::table('nutrition_calculations', function (Blueprint $table) {

            // Berat badan ideal
            if (!Schema::hasColumn('nutrition_calculations', 'ideal_weight')) {
                $table->decimal('ideal_weight', 8, 2)
                    ->nullable()
                    ->after('bmi');
            }

            // Height Age dalam bulan
            if (!Schema::hasColumn('nutrition_calculations', 'height_age_months')) {
                $table->unsignedInteger('height_age_months')
                    ->nullable()
                    ->after('ideal_weight');
            }

            // Kebutuhan energi per kg berat badan
            if (!Schema::hasColumn('nutrition_calculations', 'energy_per_kg')) {
                $table->decimal('energy_per_kg', 8, 2)
                    ->nullable()
                    ->after('height_age_months');
            }

            // Kebutuhan energi total per hari
            if (!Schema::hasColumn('nutrition_calculations', 'energy_requirement')) {
                $table->decimal('energy_requirement', 8, 2)
                    ->nullable()
                    ->after('energy_per_kg');
            }

            // Persentase makanan padat
            if (!Schema::hasColumn('nutrition_calculations', 'solid_percentage')) {
                $table->decimal('solid_percentage', 5, 2)
                    ->nullable()
                    ->after('energy_requirement');
            }

            // Persentase ASI / liquid food
            if (!Schema::hasColumn('nutrition_calculations', 'liquid_percentage')) {
                $table->decimal('liquid_percentage', 5, 2)
                    ->nullable()
                    ->after('solid_percentage');
            }

            // Energi dari makanan padat
            if (!Schema::hasColumn('nutrition_calculations', 'solid_energy')) {
                $table->decimal('solid_energy', 8, 2)
                    ->nullable()
                    ->after('liquid_percentage');
            }

            // Energi dari ASI / liquid food
            if (!Schema::hasColumn('nutrition_calculations', 'liquid_energy')) {
                $table->decimal('liquid_energy', 8, 2)
                    ->nullable()
                    ->after('solid_energy');
            }

            // Jumlah liquid food / ASI dalam ml per hari
            if (!Schema::hasColumn('nutrition_calculations', 'liquid_ml')) {
                $table->decimal('liquid_ml', 8, 2)
                    ->nullable()
                    ->after('liquid_energy');
            }

            // Detail food quantitative
            if (!Schema::hasColumn('nutrition_calculations', 'food_quantitative')) {
                $table->json('food_quantitative')
                    ->nullable()
                    ->after('liquid_ml');
            }
        });
    }

    /**
     * Migration ini sengaja tidak menghapus kolom.
     *
     * Alasannya, beberapa kolom mungkin sudah dibuat
     * oleh migration sebelumnya. Jadi kita tidak ingin
     * rollback migration ini malah menghapus data lama.
     */
    public function down(): void
    {
        // Tidak melakukan apa-apa.
    }
};