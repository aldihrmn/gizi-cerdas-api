<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NutritionCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'age',
        'weight',
        'height',
        'energy',
        'protein',
        'fat',
        'carbohydrate',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'energy' => 'decimal:2',
        'protein' => 'decimal:2',
        'fat' => 'decimal:2',
        'carbohydrate' => 'decimal:2',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}
