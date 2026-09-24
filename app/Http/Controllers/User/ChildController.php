<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan semua anak milik user yang sedang login
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $children = Child::where(
            'user_id',
            Auth::id()
        )
        ->orderBy('name', 'asc')
        ->get();

        return view(
            'user.children.index',
            compact('children')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Form tambah anak
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('user.children.create');
    }


    /*
    |--------------------------------------------------------------------------
    | Menyimpan anak baru
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100'
            ],

            'birth_date' => [
                'required',
                'date'
            ],

            'gender' => [
                'required',
                'in:L,P'
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0',
                'max:300'
            ],

            'height' => [
                'required',
                'numeric',
                'min:0',
                'max:250'
            ],
        ], [

            'name.required' => 'Nama anak wajib diisi.',

            'birth_date.required' =>
                'Tanggal lahir wajib diisi.',

            'birth_date.date' =>
                'Format tanggal lahir tidak valid.',

            'gender.required' =>
                'Jenis kelamin wajib dipilih.',

            'gender.in' =>
                'Jenis kelamin tidak valid.',

            'weight.required' =>
                'Berat badan wajib diisi.',

            'weight.numeric' =>
                'Berat badan harus berupa angka.',

            'height.required' =>
                'Tinggi badan wajib diisi.',

            'height.numeric' =>
                'Tinggi badan harus berupa angka.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Jangan izinkan tanggal lahir di masa depan
        |--------------------------------------------------------------------------
        */

        if (
            \Carbon\Carbon::parse(
                $validated['birth_date']
            )->isFuture()
        ) {
            return back()
                ->withErrors([
                    'birth_date' =>
                        'Tanggal lahir tidak boleh lebih dari hari ini.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan data anak
        |--------------------------------------------------------------------------
        */

        Child::create([

            'user_id' => Auth::id(),

            'name' => $validated['name'],

            'birth_date' => $validated['birth_date'],

            'gender' => $validated['gender'],

            'weight' => $validated['weight'],

            'height' => $validated['height'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Kembali ke daftar anak
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('user.children.index')
            ->with(
                'success',
                'Data anak berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Form edit anak
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $child = Child::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view(
            'user.children.edit',
            compact('child')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update anak
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    ) {
        $child = Child::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100'
            ],

            'birth_date' => [
                'required',
                'date'
            ],

            'gender' => [
                'required',
                'in:L,P'
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0',
                'max:300'
            ],

            'height' => [
                'required',
                'numeric',
                'min:0',
                'max:250'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek tanggal lahir
        |--------------------------------------------------------------------------
        */

        if (
            \Carbon\Carbon::parse(
                $validated['birth_date']
            )->isFuture()
        ) {
            return back()
                ->withErrors([
                    'birth_date' =>
                        'Tanggal lahir tidak boleh lebih dari hari ini.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $child->update([

            'name' => $validated['name'],

            'birth_date' => $validated['birth_date'],

            'gender' => $validated['gender'],

            'weight' => $validated['weight'],

            'height' => $validated['height'],

        ]);


        return redirect()
            ->route('user.children.index')
            ->with(
                'success',
                'Data anak berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus anak
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $child = Child::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $child->delete();

        return redirect()
            ->route('user.children.index')
            ->with(
                'success',
                'Data anak berhasil dihapus.'
            );
    }
}