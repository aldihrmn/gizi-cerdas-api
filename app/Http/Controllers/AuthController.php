<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan halaman login
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | Proses login
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        /*
        | Validasi form login
        */

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        /*
        | Cek email dan password
        */

        if (Auth::attempt($credentials)) {

            /*
            | Membuat session baru
            | setelah login berhasil.
            */

            $request->session()->regenerate();


            /*
            | Jika role admin
            | masuk ke dashboard admin.
            */

            if (Auth::user()->role === 'admin') {

                return redirect()
                    ->route('admin.dashboard');
            }


            /*
            | Selain admin dianggap sebagai user.
            */

            return redirect()
                ->route('user.dashboard');
        }


        /*
        | Login gagal
        */

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        /*
        | Hapus session
        */

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()
            ->route('login');
    }
}