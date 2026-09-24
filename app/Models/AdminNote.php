<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminNote extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Tabel
    |--------------------------------------------------------------------------
    */

    protected $table = 'admin_notes';


    /*
    |--------------------------------------------------------------------------
    | Kolom yang boleh diisi
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'user_id',
        'child_id',
        'admin_id',
        'note',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relasi ke User penerima
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Anak
    |--------------------------------------------------------------------------
    */

    public function child(): BelongsTo
    {
        return $this->belongsTo(
            Child::class,
            'child_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Admin pembuat catatan
    |--------------------------------------------------------------------------
    */

    public function admin(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'admin_id'
        );
    }
}