<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Memastikan user yang membuka halaman admin
     * benar-benar mempunyai role admin.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        /*
        | Jika belum login
        */
        if (!auth()->check()) {
            return redirect()->route('login');
        }


        /*
        | Jika sudah login tetapi bukan admin
        */
        if (auth()->user()->role !== 'admin') {

            return redirect()
                ->route('user.dashboard')
                ->with(
                    'error',
                    'Halaman tersebut hanya dapat diakses oleh admin.'
                );
        }


        return $next($request);
    }
}