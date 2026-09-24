<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\GrowthRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrowthController extends Controller
{
    /**
     * Menampilkan halaman pertumbuhan anak.
     */
    public function index(Request $request)
    {
        // Ambil semua anak milik user yang sedang login
        $children = Child::where(
            'user_id',
            Auth::id()
        )
            ->orderBy('name')
            ->get();

        // Kalau belum ada data anak
        if ($children->isEmpty()) {

            return view(
                'user.growth.index',
                [
                    'children' => $children,
                    'selectedChild' => null,
                    'growthRecords' => collect(),
                    'latestRecord' => null,
                ]
            );
        }

        /*
         * Ambil child_id dari URL.
         * Kalau tidak ada, pilih anak pertama.
         */
        $selectedChildId = $request->input(
            'child_id',
            $children->first()->id
        );

        // Pastikan anak milik user yang login
        $selectedChild = Child::where(
            'id',
            $selectedChildId
        )
            ->where(
                'user_id',
                Auth::id()
            )
            ->first();

        // Kalau tidak valid, gunakan anak pertama
        if (!$selectedChild) {

            $selectedChild = $children->first();
        }

        /*
         * Ambil seluruh riwayat pengukuran
         * anak yang sedang dipilih.
         */
        $growthRecords = GrowthRecord::where(
            'child_id',
            $selectedChild->id
        )
            ->orderBy(
                'record_date',
                'asc'
            )
            ->get();

        /*
         * Ambil pengukuran terbaru.
         */
        $latestRecord = GrowthRecord::where(
            'child_id',
            $selectedChild->id
        )
            ->orderByDesc(
                'record_date'
            )
            ->first();

        return view(
            'user.growth.index',
            [
                'children' => $children,
                'selectedChild' => $selectedChild,
                'growthRecords' => $growthRecords,
                'latestRecord' => $latestRecord,
            ]
        );
    }


    /**
     * Menampilkan detail satu pengukuran.
     */
    public function show($id)
    {
        /*
         * Ambil data pengukuran sekaligus
         * dengan data anak.
         *
         * Hanya data milik user yang login.
         */
        $growthRecord = GrowthRecord::with('child')
            ->whereHas(
                'child',
                function ($query) {
                    $query->where(
                        'user_id',
                        Auth::id()
                    );
                }
            )
            ->findOrFail($id);

        /*
         * Kirim dengan nama $growthRecord
         * supaya sama dengan Blade.
         */
        return view(
            'user.growth.show',
            compact(
                'growthRecord'
            )
        );
    }


    /**
     * Menampilkan form tambah pengukuran.
     */
    public function create()
    {
        // Ambil anak milik user
        $children = Child::where(
            'user_id',
            Auth::id()
        )
            ->orderBy('name')
            ->get();

        return view(
            'user.growth.create',
            compact(
                'children'
            )
        );
    }


    /**
     * Menyimpan pengukuran baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'child_id' =>
                    'required|integer|exists:children,id',

                'record_date' =>
                    'required|date',

                'weight' =>
                    'required|numeric|min:0.1|max:200',

                'height' =>
                    'required|numeric|min:10|max:250',
            ],
            [
                'child_id.required' =>
                    'Anak wajib dipilih.',

                'child_id.exists' =>
                    'Data anak tidak ditemukan.',

                'record_date.required' =>
                    'Tanggal pengukuran wajib diisi.',

                'record_date.date' =>
                    'Format tanggal pengukuran tidak valid.',

                'weight.required' =>
                    'Berat badan wajib diisi.',

                'weight.numeric' =>
                    'Berat badan harus berupa angka.',

                'height.required' =>
                    'Tinggi badan wajib diisi.',

                'height.numeric' =>
                    'Tinggi badan harus berupa angka.',
            ]
        );


        /*
         * Pastikan anak benar-benar milik
         * user yang sedang login.
         */
        $child = Child::where(
            'id',
            $validated['child_id']
        )
            ->where(
                'user_id',
                Auth::id()
            )
            ->firstOrFail();


        $recordDate = Carbon::parse(
            $validated['record_date']
        );


        $birthDate = Carbon::parse(
            $child->birth_date
        );


        /*
         * Pengukuran tidak boleh sebelum
         * tanggal lahir.
         */
        if ($recordDate->lt($birthDate)) {

            return back()
                ->withErrors(
                    [
                        'record_date' =>
                            'Tanggal pengukuran tidak boleh sebelum tanggal lahir anak.',
                    ]
                )
                ->withInput();
        }


        /*
         * Pengukuran tidak boleh lebih dari
         * hari ini.
         */
        if ($recordDate->gt(Carbon::today())) {

            return back()
                ->withErrors(
                    [
                        'record_date' =>
                            'Tanggal pengukuran tidak boleh lebih dari hari ini.',
                    ]
                )
                ->withInput();
        }


        /*
         * Simpan data.
         */
        GrowthRecord::create(
            [
                'child_id' =>
                    $child->id,

                'record_date' =>
                    $recordDate->toDateString(),

                'weight' =>
                    $validated['weight'],

                'height' =>
                    $validated['height'],
            ]
        );


        return redirect()
            ->route(
                'user.growth.index',
                [
                    'child_id' =>
                        $child->id,
                ]
            )
            ->with(
                'success',
                'Data pertumbuhan berhasil disimpan.'
            );
    }


    /**
     * Menampilkan form edit pengukuran.
     */
    public function edit($id)
    {
        /*
         * Ambil data pengukuran.
         *
         * Hanya data milik user yang login
         * yang boleh diedit.
         */
        $growthRecord = GrowthRecord::with('child')
            ->whereHas(
                'child',
                function ($query) {
                    $query->where(
                        'user_id',
                        Auth::id()
                    );
                }
            )
            ->findOrFail($id);


        /*
         * Ambil semua anak milik user.
         * Ini digunakan pada dropdown.
         */
        $children = Child::where(
            'user_id',
            Auth::id()
        )
            ->orderBy('name')
            ->get();


        /*
         * PENTING:
         * Kita kirim nama $growthRecord.
         *
         * Ini harus sama dengan yang digunakan
         * di edit.blade.php.
         */
        return view(
            'user.growth.edit',
            compact(
                'growthRecord',
                'children'
            )
        );
    }


    /**
     * Memperbarui data pengukuran.
     */
    public function update(
        Request $request,
        $id
    ) {

        /*
         * Ambil record yang sedang diedit.
         */
        $growthRecord = GrowthRecord::with('child')
            ->whereHas(
                'child',
                function ($query) {
                    $query->where(
                        'user_id',
                        Auth::id()
                    );
                }
            )
            ->findOrFail($id);


        /*
         * Validasi data dari form.
         */
        $validated = $request->validate(
            [
                'child_id' =>
                    'required|integer|exists:children,id',

                'record_date' =>
                    'required|date',

                'weight' =>
                    'required|numeric|min:0.1|max:200',

                'height' =>
                    'required|numeric|min:10|max:250',
            ],
            [
                'child_id.required' =>
                    'Anak wajib dipilih.',

                'child_id.exists' =>
                    'Data anak tidak ditemukan.',

                'record_date.required' =>
                    'Tanggal pengukuran wajib diisi.',

                'record_date.date' =>
                    'Format tanggal pengukuran tidak valid.',

                'weight.required' =>
                    'Berat badan wajib diisi.',

                'weight.numeric' =>
                    'Berat badan harus berupa angka.',

                'height.required' =>
                    'Tinggi badan wajib diisi.',

                'height.numeric' =>
                    'Tinggi badan harus berupa angka.',
            ]
        );


        /*
         * Pastikan anak yang dipilih
         * adalah milik user yang login.
         */
        $child = Child::where(
            'id',
            $validated['child_id']
        )
            ->where(
                'user_id',
                Auth::id()
            )
            ->first();


        if (!$child) {

            return back()
                ->withErrors(
                    [
                        'child_id' =>
                            'Data anak tidak valid.',
                    ]
                )
                ->withInput();
        }


        $recordDate = Carbon::parse(
            $validated['record_date']
        );


        $birthDate = Carbon::parse(
            $child->birth_date
        );


        /*
         * Tanggal tidak boleh sebelum lahir.
         */
        if ($recordDate->lt($birthDate)) {

            return back()
                ->withErrors(
                    [
                        'record_date' =>
                            'Tanggal pengukuran tidak boleh sebelum tanggal lahir anak.',
                    ]
                )
                ->withInput();
        }


        /*
         * Tanggal tidak boleh lebih dari hari ini.
         */
        if ($recordDate->gt(Carbon::today())) {

            return back()
                ->withErrors(
                    [
                        'record_date' =>
                            'Tanggal pengukuran tidak boleh lebih dari hari ini.',
                    ]
                )
                ->withInput();
        }


        /*
         * Update data.
         */
        $growthRecord->update(
            [
                'child_id' =>
                    $child->id,

                'record_date' =>
                    $recordDate->toDateString(),

                'weight' =>
                    $validated['weight'],

                'height' =>
                    $validated['height'],
            ]
        );


        /*
         * Kembali ke halaman pertumbuhan
         * anak yang baru diperbarui.
         */
        return redirect()
            ->route(
                'user.growth.index',
                [
                    'child_id' =>
                        $child->id,
                ]
            )
            ->with(
                'success',
                'Data pertumbuhan berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data pengukuran.
     */
    public function destroy($id)
    {
        /*
         * Cari data yang hanya dimiliki user
         * yang sedang login.
         */
        $growthRecord = GrowthRecord::with('child')
            ->whereHas(
                'child',
                function ($query) {
                    $query->where(
                        'user_id',
                        Auth::id()
                    );
                }
            )
            ->findOrFail($id);


        /*
         * Simpan child_id untuk redirect.
         */
        $childId =
            $growthRecord->child_id;


        /*
         * Hapus data.
         */
        $growthRecord->delete();


        /*
         * Kembali ke halaman pertumbuhan.
         */
        return redirect()
            ->route(
                'user.growth.index',
                [
                    'child_id' =>
                        $childId,
                ]
            )
            ->with(
                'success',
                'Data pertumbuhan berhasil dihapus.'
            );
    }
}