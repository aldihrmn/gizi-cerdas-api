<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AdminNote;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan catatan dari admin
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil ID user yang sedang login
        |--------------------------------------------------------------------------
        */

        $userId = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Ambil catatan milik user
        |--------------------------------------------------------------------------
        |
        | User hanya akan melihat catatan dengan user_id
        | yang sama dengan akun yang sedang login.
        |
        */

        $notes = AdminNote::with([
            'child',
            'admin'
        ])
        ->where(
            'user_id',
            $userId
        )
        ->latest()
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Kirim ke halaman user/notes/index.blade.php
        |--------------------------------------------------------------------------
        */

        return view(
            'user.notes.index',
            compact('notes')
        );
    }
}