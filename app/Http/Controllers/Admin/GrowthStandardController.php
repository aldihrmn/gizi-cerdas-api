<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GrowthStandard;

class GrowthStandardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan data standar gizi
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $standards = GrowthStandard::orderBy('gender')
            ->orderBy('index_type')
            ->orderBy('age_month')
            ->get();

        return view(
            'admin.growth-standards.index',
            compact('standards')
        );
    }
}