<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'birth_date',
        'gender',
        'weight',
        'height',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relasi ke User / Orang Tua
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Perhitungan Nutrisi
    |--------------------------------------------------------------------------
    */

    public function nutritionCalculations(): HasMany
    {
        return $this->hasMany(NutritionCalculation::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Data Pertumbuhan
    |--------------------------------------------------------------------------
    */

    public function growthRecords(): HasMany
    {
        return $this->hasMany(GrowthRecord::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Catatan Admin
    |--------------------------------------------------------------------------
    */

    public function adminNotes(): HasMany
    {
        return $this->hasMany(
            AdminNote::class,
            'child_id'
        );
    }
}