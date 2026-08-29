<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrowthStandard extends Model
{
    protected $table = 'growth_standards';

    protected $fillable = [
        'gender',
        'age_month',

        'weight_sd3_min',
        'weight_sd2_min',
        'weight_sd1_min',
        'weight_median',
        'weight_sd1_max',
        'weight_sd2_max',
        'weight_sd3_max',

        'height_sd3_min',
        'height_sd2_min',
        'height_sd1_min',
        'height_median',
        'height_sd1_max',
        'height_sd2_max',
        'height_sd3_max',
    ];

    protected $casts = [
        'age_month' => 'integer',

        'weight_sd3_min' => 'float',
        'weight_sd2_min' => 'float',
        'weight_sd1_min' => 'float',
        'weight_median' => 'float',
        'weight_sd1_max' => 'float',
        'weight_sd2_max' => 'float',
        'weight_sd3_max' => 'float',

        'height_sd3_min' => 'float',
        'height_sd2_min' => 'float',
        'height_sd1_min' => 'float',
        'height_median' => 'float',
        'height_sd1_max' => 'float',
        'height_sd2_max' => 'float',
        'height_sd3_max' => 'float',
    ];
}
