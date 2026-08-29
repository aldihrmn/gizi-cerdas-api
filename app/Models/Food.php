<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'category',
        'calories',
        'protein',
        'fat',
        'carbohydrate',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'calories' => 'decimal:2',
        'protein' => 'decimal:2',
        'fat' => 'decimal:2',
        'carbohydrate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class);
    }
}
