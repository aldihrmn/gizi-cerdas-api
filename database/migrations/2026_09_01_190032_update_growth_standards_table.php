<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('growth_standards');

        Schema::create('growth_standards', function (Blueprint $table) {
            $table->id();

            // Jenis kelamin
            $table->enum('gender', [
                'male',
                'female'
            ]);

            /*
             * Jenis indeks antropometri
             *
             * wfa  = Berat Badan menurut Umur (BB/U)
             * lfa  = Panjang Badan menurut Umur (PB/U)
             * hfa  = Tinggi Badan menurut Umur (TB/U)
             * wfl  = Berat Badan menurut Panjang Badan (BB/PB)
             * wfh  = Berat Badan menurut Tinggi Badan (BB/TB)
             * bmiu = Indeks Massa Tubuh menurut Umur (IMT/U)
             */
            $table->enum('index_type', [
                'wfa',
                'lfa',
                'hfa',
                'wfl',
                'wfh',
                'bmiu'
            ]);

            /*
             * Umur dalam bulan.
             *
             * Dipakai untuk:
             * BB/U
             * PB/U
             * TB/U
             * IMT/U
             */
            $table->unsignedInteger('age_month')->nullable();

            /*
             * Nilai pengukuran standar.
             *
             * Untuk:
             * BB/U  -> tidak digunakan
             * PB/U  -> tidak digunakan
             * TB/U  -> tidak digunakan
             * IMT/U -> tidak digunakan
             *
             * Untuk:
             * BB/PB -> panjang badan
             * BB/TB -> tinggi badan
             */
            $table->decimal('measurement_value', 6, 2)->nullable();

            /*
             * Satuan nilai standar
             */
            $table->enum('measurement_unit', [
                'month',
                'cm'
            ]);

            /*
             * Nilai standar Z-score
             */

            $table->decimal('sd_minus_3', 7, 3)->nullable();

            $table->decimal('sd_minus_2', 7, 3)->nullable();

            $table->decimal('sd_minus_1', 7, 3)->nullable();

            $table->decimal('median', 7, 3)->nullable();

            $table->decimal('sd_plus_1', 7, 3)->nullable();

            $table->decimal('sd_plus_2', 7, 3)->nullable();

            $table->decimal('sd_plus_3', 7, 3)->nullable();

            $table->timestamps();

            /*
             * Nama index dibuat pendek
             * agar tidak terkena batas panjang MySQL.
             */
            $table->unique(
                [
                    'gender',
                    'index_type',
                    'age_month',
                    'measurement_value'
                ],
                'growth_std_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('growth_standards');
    }
};