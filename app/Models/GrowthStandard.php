<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthStandard extends Model
{
    use HasFactory;

    protected $table = 'growth_standards';

    protected $fillable = [
        'gender',
        'index_type',
        'age_month',
        'measurement_value',
        'measurement_unit',
        'sd_minus_3',
        'sd_minus_2',
        'sd_minus_1',
        'median',
        'sd_plus_1',
        'sd_plus_2',
        'sd_plus_3',
    ];

    protected $casts = [
        'age_month' => 'integer',

        'measurement_value' => 'decimal:2',

        'sd_minus_3' => 'decimal:3',
        'sd_minus_2' => 'decimal:3',
        'sd_minus_1' => 'decimal:3',

        'median' => 'decimal:3',

        'sd_plus_1' => 'decimal:3',
        'sd_plus_2' => 'decimal:3',
        'sd_plus_3' => 'decimal:3',
    ];
}