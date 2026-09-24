<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom kebutuhan energi,
     * zat gizi makro, dan food quantitative.
     */
    public function up(): void
    {
        Schema::table('nutrition_calculations', function (Blueprint $table) {

            // Kebutuhan energi dalam satuan kkal per hari
            $table->decimal('energy_requirement', 8, 2)
                ->nullable()
                ->after('bmi');

            // Kebutuhan protein dalam gram per hari
            $table->decimal('protein_requirement', 8, 2)
                ->nullable()
                ->after('energy_requirement');

            // Kebutuhan lemak dalam gram per hari
            $table->decimal('fat_requirement', 8, 2)
                ->nullable()
                ->after('protein_requirement');

            // Kebutuhan karbohidrat dalam gram per hari
            $table->decimal('carbohydrate_requirement', 8, 2)
                ->nullable()
                ->after('fat_requirement');

            // Food quantitative disimpan dalam bentuk JSON
            $table->json('food_quantitative')
                ->nullable()
                ->after('carbohydrate_requirement');
        });
    }

    /**
     * Menghapus kembali kolom jika migration dibatalkan.
     */
    public function down(): void
    {
        Schema::table('nutrition_calculations', function (Blueprint $table) {

            $table->dropColumn([
                'energy_requirement',
                'protein_requirement',
                'fat_requirement',
                'carbohydrate_requirement',
                'food_quantitative',
            ]);
        });
    }
};