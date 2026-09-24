<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\GrowthRecord;
use Illuminate\Http\Request;

class GrowthController extends Controller
{
    public function index()
    {
        $growthRecords = GrowthRecord::with(['child.user'])
            ->latest('record_date')
            ->latest('id')
            ->get();

        return view('admin.growth.index', compact('growthRecords'));
    }

    public function create()
    {
        $children = Child::with('user')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.growth.create', compact('children'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => ['required', 'exists:children,id'],
            'record_date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'min:0.1', 'max:999.99'],
            'height' => ['required', 'numeric', 'min:0.1', 'max:999.99'],
        ]);

        GrowthRecord::create($validated);

        return redirect()
            ->route('admin.growth.index')
            ->with('success', 'Data pertumbuhan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $growth = GrowthRecord::findOrFail($id);

        $children = Child::with('user')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.growth.edit', compact('growth', 'children'));
    }

    public function update(Request $request, $id)
    {
        $growth = GrowthRecord::findOrFail($id);

        $validated = $request->validate([
            'child_id' => ['required', 'exists:children,id'],
            'record_date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'min:0.1', 'max:999.99'],
            'height' => ['required', 'numeric', 'min:0.1', 'max:999.99'],
        ]);

        $growth->update($validated);

        return redirect()
            ->route('admin.growth.index')
            ->with('success', 'Data pertumbuhan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $growth = GrowthRecord::findOrFail($id);

        $growth->delete();

        return redirect()
            ->route('admin.growth.index')
            ->with('success', 'Data pertumbuhan berhasil dihapus.');
    }
}