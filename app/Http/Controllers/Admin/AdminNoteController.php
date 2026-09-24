<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNote;
use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNoteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menampilkan semua catatan
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $notes = AdminNote::with([
            'user',
            'child',
            'admin'
        ])
        ->latest()
        ->get();

        return view(
            'admin.notes.index',
            compact('notes')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Form tambah catatan
    |--------------------------------------------------------------------------
    |
    | Bisa dibuka dengan:
    |
    | /admin/notes/create
    |
    | atau:
    |
    | /admin/notes/create/7
    |
    | Angka 7 adalah ID anak.
    |
    */

    public function create($childId = null)
    {
        /*
        |--------------------------------------------------------------------------
        | Anak yang dipilih
        |--------------------------------------------------------------------------
        */

        $selectedChild = null;

        if ($childId !== null) {
            $selectedChild = Child::with('user')
                ->findOrFail($childId);
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil semua anak
        |--------------------------------------------------------------------------
        */

        $children = Child::with('user')
            ->orderBy('name', 'asc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Ambil semua user
        |--------------------------------------------------------------------------
        |
        | Disiapkan agar view tidak error apabila membutuhkan
        | data user.
        |
        */

        $users = User::orderBy('name', 'asc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Kirim data ke halaman create
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.notes.create',
            compact(
                'children',
                'users',
                'selectedChild'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Menyimpan catatan
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
            'child_id' => [
                'required',
                'exists:children,id'
            ],

            'note' => [
                'required',
                'string'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cari anak
        |--------------------------------------------------------------------------
        */

        $child = Child::findOrFail(
            $validated['child_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Simpan catatan
        |--------------------------------------------------------------------------
        */

        AdminNote::create([
            'user_id' => $child->user_id,
            'child_id' => $child->id,
            'admin_id' => Auth::id(),
            'note' => $validated['note'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman catatan
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.notes.index')
            ->with(
                'success',
                'Catatan berhasil disimpan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Menampilkan detail catatan
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $note = AdminNote::with([
            'user',
            'child',
            'admin'
        ])
        ->findOrFail($id);

        return view(
            'admin.notes.show',
            compact('note')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Menghapus catatan
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $note = AdminNote::findOrFail($id);

        $note->delete();

        return redirect()
            ->route('admin.notes.index')
            ->with(
                'success',
                'Catatan berhasil dihapus.'
            );
    }
}