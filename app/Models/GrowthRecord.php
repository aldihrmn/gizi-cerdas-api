<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrowthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'record_date',
        'weight',
        'height',
    ];

    protected $casts = [
        'record_date' => 'date',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
    ];

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }
}