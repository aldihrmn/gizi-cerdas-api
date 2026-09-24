<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;

class EducationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan data edukasi
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $educations = Education::latest('id')->get();

        return view('admin.education.index', compact('educations'));
    }
}