<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nutrition_calculations', function (Blueprint $table) {
            $table->id();

            // Anak yang dihitung gizinya
            $table->foreignId('child_id')
                ->constrained('children')
                ->cascadeOnDelete();

            // Tanggal perhitungan
            $table->date('calculation_date');

            // Umur anak saat perhitungan (bulan)
            $table->integer('age_in_months');

            // Berat badan
            $table->decimal('weight', 5, 2);

            // Tinggi badan
            $table->decimal('height', 5, 2);

            // Indeks Massa Tubuh
            $table->decimal('bmi', 6, 2)->nullable();

            // Status gizi
            $table->string('nutrition_status');

            // Catatan / rekomendasi
            $table->text('recommendation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_calculations');
    }
};