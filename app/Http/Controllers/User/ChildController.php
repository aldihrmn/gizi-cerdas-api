<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        $children = Child::where('user_id', auth()->id())->get();

        return view('user.children.index', compact('children'));
    }

    public function create()
    {
        return view('user.children.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        Child::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return redirect()->route('user.children.index')
            ->with('success', 'Data anak berhasil ditambahkan.');
    }
}
