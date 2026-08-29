<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\NutritionCalculation;
use Illuminate\Http\Request;

class NutritionController extends Controller
{
    public function create()
    {
        $children = Child::where('user_id', auth()->id())->get();

        return view('user.nutrition.create', compact('children'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        $child = Child::where('id', $request->child_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $age = $child->birth_date->diffInMonths(now());

        if ($age <= 6) {
            $energyPerKg = 120;
        } elseif ($age <= 12) {
            $energyPerKg = 110;
        } elseif ($age <= 36) {
            $energyPerKg = 100;
        } elseif ($age <= 72) {
            $energyPerKg = 90;
        } else {
            $energyPerKg = 80;
        }

        $energy = $request->weight * $energyPerKg;

        $protein = $energy * 0.10 / 4;
        $fat = $energy * 0.30 / 9;
        $carbohydrate = $energy * 0.60 / 4;

        $calculation = NutritionCalculation::create([
            'child_id' => $child->id,
            'age' => $age,
            'weight' => $request->weight,
            'height' => $request->height,
            'energy' => $energy,
            'protein' => $protein,
            'fat' => $fat,
            'carbohydrate' => $carbohydrate,
        ]);

        $growthRecords = $child->growthRecords()
            ->orderBy('record_date')
            ->get();

        return view('user.nutrition.result', compact(
            'child',
            'calculation',
            'growthRecords'
        ));
    }
}
