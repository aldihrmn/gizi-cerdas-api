<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        $children = Child::with('user')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.children.index', compact('children'));
    }


    public function create()
    {
        $users = User::where('role', 'user')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.children.create', compact('users'));
    }


    public function store(Request $request)
    {
        $gender = $request->gender;

        if ($gender === 'Laki-laki') {
            $gender = 'L';
        }

        if ($gender === 'Perempuan') {
            $gender = 'P';
        }

        $request->merge([
            'gender' => $gender,
        ]);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ], [
            'user_id.required' => 'Orang tua / user wajib dipilih.',
            'user_id.exists' => 'User yang dipilih tidak ditemukan.',
            'name.required' => 'Nama anak wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'birth_date.date' => 'Format tanggal lahir tidak valid.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'gender.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'weight.required' => 'Berat badan wajib diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'height.required' => 'Tinggi badan wajib diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
        ]);

        Child::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return redirect()
            ->route('admin.children.index')
            ->with('success', 'Data anak berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $child = Child::findOrFail($id);

        $users = User::where('role', 'user')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.children.edit', compact('child', 'users'));
    }


    public function update(Request $request, $id)
    {
        $child = Child::findOrFail($id);

        $gender = $request->gender;

        if ($gender === 'Laki-laki') {
            $gender = 'L';
        }

        if ($gender === 'Perempuan') {
            $gender = 'P';
        }

        $request->merge([
            'gender' => $gender,
        ]);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ], [
            'user_id.required' => 'Orang tua / user wajib dipilih.',
            'user_id.exists' => 'User yang dipilih tidak ditemukan.',
            'name.required' => 'Nama anak wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'birth_date.date' => 'Format tanggal lahir tidak valid.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'gender.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'weight.required' => 'Berat badan wajib diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'height.required' => 'Tinggi badan wajib diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
        ]);

        $child->update([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return redirect()
            ->route('admin.children.index')
            ->with('success', 'Data anak berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $child = Child::findOrFail($id);

        $child->delete();

        return redirect()
            ->route('admin.children.index')
            ->with('success', 'Data anak berhasil dihapus.');
    }
}