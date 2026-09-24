<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    /*
    |--------------------------------------------------------------------------
    | Kolom yang boleh diisi
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];


    /*
    |--------------------------------------------------------------------------
    | Kolom tersembunyi
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];


    /*
    |--------------------------------------------------------------------------
    | Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Anak
    |--------------------------------------------------------------------------
    */

    public function children(): HasMany
    {
        return $this->hasMany(Child::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi sebagai penerima catatan Admin
    |--------------------------------------------------------------------------
    */

    public function adminNotes(): HasMany
    {
        return $this->hasMany(
            AdminNote::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi sebagai Admin pembuat catatan
    |--------------------------------------------------------------------------
    */

    public function notesCreated(): HasMany
    {
        return $this->hasMany(
            AdminNote::class,
            'admin_id'
        );
    }
}