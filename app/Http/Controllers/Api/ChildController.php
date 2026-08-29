<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index(Request $request)
    {
        $children = Child::where('user_id', $request->user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil diambil',
            'data' => $children
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ]);

        $child = Child::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil ditambahkan',
            'data' => $child
        ], 201);
    }

    public function show(Request $request, Child $child)
    {
        if ($child->user_id != $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil diambil',
            'data' => $child
        ]);
    }

    public function update(Request $request, Child $child)
    {
        if ($child->user_id != $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ]);

        $child->update([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil diubah',
            'data' => $child
        ]);
    }

    public function destroy(Request $request, Child $child)
    {
        if ($child->user_id != $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Data anak tidak ditemukan'
            ], 404);
        }

        $child->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data anak berhasil dihapus'
        ]);
    }
}
