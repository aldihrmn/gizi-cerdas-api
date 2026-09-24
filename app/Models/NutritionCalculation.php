<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NutritionCalculation extends Model
{
    use HasFactory;

    protected $table = 'nutrition_calculations';

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        // Data anak
        'child_id',
        'calculation_date',

        // Data dasar
        'age_in_months',
        'weight',
        'height',
        'bmi',

        // Hasil status gizi
        'nutrition_status',
        'recommendation',

        // Kebutuhan energi
        'ideal_weight',
        'height_age_months',
        'energy_per_kg',
        'energy_requirement',

        // Pembagian food quantity
        'solid_percentage',
        'liquid_percentage',
        'solid_energy',
        'liquid_energy',
        'liquid_ml',

        // Kebutuhan zat gizi makro
        'protein_requirement',
        'fat_requirement',
        'carbohydrate_requirement',

        // Detail food quantitative
        'food_quantitative',
    ];

    /**
     * Konversi tipe data dari database.
     */
    protected $casts = [
        // Tanggal
        'calculation_date' => 'date',

        // Umur
        'age_in_months' => 'integer',
        'height_age_months' => 'integer',

        // Data antropometri
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'bmi' => 'decimal:2',

        // Kebutuhan energi
        'ideal_weight' => 'decimal:2',
        'energy_per_kg' => 'decimal:2',
        'energy_requirement' => 'decimal:2',

        // Food quantity
        'solid_percentage' => 'decimal:2',
        'liquid_percentage' => 'decimal:2',
        'solid_energy' => 'decimal:2',
        'liquid_energy' => 'decimal:2',
        'liquid_ml' => 'decimal:2',

        // Zat gizi makro
        'protein_requirement' => 'decimal:2',
        'fat_requirement' => 'decimal:2',
        'carbohydrate_requirement' => 'decimal:2',

        // JSON otomatis menjadi array PHP
        'food_quantitative' => 'array',
    ];

    /**
     * Relasi ke data anak.
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}