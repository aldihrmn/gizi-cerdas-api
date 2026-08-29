<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ChildController;
use App\Http\Controllers\User\GrowthController;
use App\Http\Controllers\User\NutritionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/user/children', [ChildController::class, 'index'])
        ->name('user.children.index');

    Route::get('/user/children/create', [ChildController::class, 'create'])
        ->name('user.children.create');

    Route::post('/user/children', [ChildController::class, 'store'])
        ->name('user.children.store');

    Route::get('/user/nutrition/create', [NutritionController::class, 'create'])
        ->name('user.nutrition.create');

    Route::post('/user/nutrition', [NutritionController::class, 'store'])
        ->name('user.nutrition.store');

    Route::get('/user/growth', [GrowthController::class, 'index'])
        ->name('user.growth.index');

    Route::get('/user/growth/{id}', [GrowthController::class, 'show'])
        ->name('user.growth.show');

    Route::get('/user/growth/{id}/create', [GrowthController::class, 'create'])
        ->name('user.growth.create');

    Route::post('/user/growth/{id}', [GrowthController::class, 'store'])
        ->name('user.growth.store');
});
