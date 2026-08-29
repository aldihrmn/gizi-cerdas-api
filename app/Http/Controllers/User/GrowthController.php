<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\GrowthRecord;
use App\Models\GrowthStandard;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GrowthController extends Controller
{
    /**
     * Menampilkan daftar anak milik user.
     */
    public function index()
    {
        $children = Child::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('user.growth.index', compact('children'));
    }

    /**
     * Menampilkan grafik pertumbuhan anak.
     */
    public function show($id)
    {
        $child = Child::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Ambil semua riwayat pertumbuhan anak
        $growthRecords = GrowthRecord::where('child_id', $child->id)
            ->orderBy('record_date', 'asc')
            ->get();

        $latestRecord = $growthRecords->last();

        /*
        |--------------------------------------------------------------------------
        | Tentukan jenis kelamin
        |--------------------------------------------------------------------------
        */

        $gender = strtolower($child->gender);

        if (in_array($gender, ['laki-laki', 'laki laki', 'male', 'l'])) {
            $standardGender = 'male';
        } else {
            $standardGender = 'female';
        }

        /*
        |--------------------------------------------------------------------------
        | Siapkan data grafik
        |--------------------------------------------------------------------------
        */

        $labels = [];
        $weights = [];
        $heights = [];

        $weightMedian = [];
        $heightMedian = [];

        /*
        |--------------------------------------------------------------------------
        | Hitung usia anak pada setiap tanggal pengukuran
        |--------------------------------------------------------------------------
        */

        foreach ($growthRecords as $record) {

            $recordDate = Carbon::parse($record->record_date);
            $birthDate = Carbon::parse($child->birth_date);

            $ageMonths = $birthDate->diffInMonths($recordDate);

            // Batasi usia ke standar yang tersedia
            if ($ageMonths < 0) {
                $ageMonths = 0;
            }

            if ($ageMonths > 12) {
                $ageMonths = 12;
            }

            /*
            |--------------------------------------------------------------------------
            | Cari standar pertumbuhan berdasarkan gender + usia
            |--------------------------------------------------------------------------
            */

            $standard = GrowthStandard::where('gender', $standardGender)
                ->where('age_month', $ageMonths)
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Data grafik
            |--------------------------------------------------------------------------
            */

            $labels[] = $recordDate->format('d-m-Y');

            $weights[] = (float) $record->weight;
            $heights[] = (float) $record->height;

            if ($standard) {
                $weightMedian[] = (float) $standard->weight_median;
                $heightMedian[] = (float) $standard->height_median;
            } else {
                $weightMedian[] = null;
                $heightMedian[] = null;
            }
        }

        return view('user.growth.show', compact(
            'child',
            'growthRecords',
            'latestRecord',
            'labels',
            'weights',
            'heights',
            'weightMedian',
            'heightMedian'
        ));
    }

    /**
     * Form tambah pengukuran.
     */
    public function create($id)
    {
        $child = Child::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.growth.create', compact('child'));
    }

    /**
     * Menyimpan data pengukuran.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'record_date' => 'required|date',
            'weight' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',
        ]);

        $child = Child::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        GrowthRecord::create([
            'child_id' => $child->id,
            'record_date' => $request->record_date,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return redirect()
            ->route('user.growth.show', $child->id)
            ->with('success', 'Data pertumbuhan berhasil ditambahkan.');
    }
}
