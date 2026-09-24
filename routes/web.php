<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

// Authentication
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ChildController as AdminChildController;
use App\Http\Controllers\Admin\GrowthController as AdminGrowthController;
use App\Http\Controllers\Admin\NutritionController as AdminNutritionController;
use App\Http\Controllers\Admin\GrowthStandardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\AdminNoteController;

// User Controllers
use App\Http\Controllers\User\ChildController as UserChildController;
use App\Http\Controllers\User\GrowthController as UserGrowthController;
use App\Http\Controllers\User\NutritionController as UserNutritionController;
use App\Http\Controllers\User\NoteController as UserNoteController;

// Models
use App\Models\User;
use App\Models\Child;
use App\Models\GrowthRecord;
use App\Models\NutritionCalculation;
use App\Models\Education;
use App\Models\GrowthStandard;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

// Menampilkan halaman login
Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');

// Memproses login
Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.process');

// Logout
Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', function () {

            // Jumlah user
            $totalUsers = User::count();

            // Jumlah anak
            $totalChildren = Child::count();

            // Jumlah data pertumbuhan
            $totalGrowth = GrowthRecord::count();

            // Nama alternatif untuk data pertumbuhan
            $totalGrowthRecords = $totalGrowth;

            // Jumlah perhitungan nutrisi
            $totalNutrition = NutritionCalculation::count();

            // Nama alternatif untuk data nutrisi
            $totalNutritionCalculations = $totalNutrition;

            // Jumlah data edukasi
            $totalEducation = Education::count();

            // Jumlah standar pertumbuhan
            $totalGrowthStandards = GrowthStandard::count();

            return view(
                'admin.dashboard',
                compact(
                    'totalUsers',
                    'totalChildren',
                    'totalGrowth',
                    'totalGrowthRecords',
                    'totalNutrition',
                    'totalNutritionCalculations',
                    'totalEducation',
                    'totalGrowthStandards'
                )
            );

        })->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | DATA USER ADMIN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            AdminUserController::class
        )->names('admin.users');


        /*
        |--------------------------------------------------------------------------
        | DATA ANAK ADMIN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'children',
            AdminChildController::class
        )->names('admin.children');


        /*
        |--------------------------------------------------------------------------
        | DATA PERTUMBUHAN ADMIN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'growth',
            AdminGrowthController::class
        )->names('admin.growth');


        /*
        |--------------------------------------------------------------------------
        | DATA NUTRISI ADMIN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'nutrition',
            AdminNutritionController::class
        )->names('admin.nutrition');


        /*
        |--------------------------------------------------------------------------
        | STANDAR PERTUMBUHAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/growth-standards',
            [GrowthStandardController::class, 'index']
        )->name('admin.growth-standards.index');


        /*
        |--------------------------------------------------------------------------
        | EDUKASI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/education',
            [EducationController::class, 'index']
        )->name('admin.education.index');


        /*
        |--------------------------------------------------------------------------
        | CATATAN ADMIN
        |--------------------------------------------------------------------------
        */

        // Daftar catatan
        Route::get(
            '/notes',
            [AdminNoteController::class, 'index']
        )->name('admin.notes.index');


        // Form membuat catatan tanpa memilih anak
        Route::get(
            '/notes/create',
            [AdminNoteController::class, 'create']
        )->name('admin.notes.create');


        // Form membuat catatan untuk anak tertentu
        Route::get(
            '/notes/create/{childId}',
            [AdminNoteController::class, 'create']
        )->name('admin.notes.create.child');


        // Simpan catatan
        Route::post(
            '/notes',
            [AdminNoteController::class, 'store']
        )->name('admin.notes.store');


        // Detail catatan
        Route::get(
            '/notes/{id}',
            [AdminNoteController::class, 'show']
        )->name('admin.notes.show');


        // Hapus catatan
        Route::delete(
            '/notes/{id}',
            [AdminNoteController::class, 'destroy']
        )->name('admin.notes.destroy');

    });


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD USER
        |--------------------------------------------------------------------------
        */

        Route::get('/user/dashboard', function () {

            // User yang sedang login
            $user = auth()->user();


            // Total anak milik user
            $totalChildren = Child::where(
                'user_id',
                $user->id
            )->count();


            // Total pertumbuhan milik user
            $totalGrowth = GrowthRecord::whereHas(
                'child',
                function ($query) use ($user) {

                    $query->where(
                        'user_id',
                        $user->id
                    );

                }
            )->count();


            // Total perhitungan nutrisi milik user
            $totalNutrition = NutritionCalculation::whereHas(
                'child',
                function ($query) use ($user) {

                    $query->where(
                        'user_id',
                        $user->id
                    );

                }
            )->count();


            // Total catatan dari admin untuk user
            $totalNotes = \App\Models\AdminNote::where(
                'user_id',
                $user->id
            )->count();


            return view(
                'user.dashboard',
                compact(
                    'user',
                    'totalChildren',
                    'totalGrowth',
                    'totalNutrition',
                    'totalNotes'
                )
            );

        })->name('user.dashboard');


        /*
        |--------------------------------------------------------------------------
        | DATA ANAK USER
        |--------------------------------------------------------------------------
        */

        // Daftar anak
        Route::get(
            '/user/children',
            [UserChildController::class, 'index']
        )->name('user.children.index');


        // Form tambah anak
        Route::get(
            '/user/children/create',
            [UserChildController::class, 'create']
        )->name('user.children.create');


        // Simpan anak
        Route::post(
            '/user/children',
            [UserChildController::class, 'store']
        )->name('user.children.store');


        // Form edit anak
        Route::get(
            '/user/children/{id}/edit',
            [UserChildController::class, 'edit']
        )->name('user.children.edit');


        // Update anak
        Route::put(
            '/user/children/{id}',
            [UserChildController::class, 'update']
        )->name('user.children.update');


        // Hapus anak
        Route::delete(
            '/user/children/{id}',
            [UserChildController::class, 'destroy']
        )->name('user.children.destroy');


        /*
        |--------------------------------------------------------------------------
        | DATA PERTUMBUHAN USER
        |--------------------------------------------------------------------------
        */

        // Daftar pertumbuhan
        Route::get(
            '/user/growth',
            [UserGrowthController::class, 'index']
        )->name('user.growth.index');


        // Form tambah pertumbuhan
        Route::get(
            '/user/growth/create',
            [UserGrowthController::class, 'create']
        )->name('user.growth.create');


        // Simpan pertumbuhan
        Route::post(
            '/user/growth',
            [UserGrowthController::class, 'store']
        )->name('user.growth.store');


        // Detail pertumbuhan
        Route::get(
            '/user/growth/{id}',
            [UserGrowthController::class, 'show']
        )->name('user.growth.show');


        // Form edit pertumbuhan
        Route::get(
            '/user/growth/{id}/edit',
            [UserGrowthController::class, 'edit']
        )->name('user.growth.edit');


        // Update pertumbuhan
        Route::put(
            '/user/growth/{id}',
            [UserGrowthController::class, 'update']
        )->name('user.growth.update');


        // Hapus pertumbuhan
        Route::delete(
            '/user/growth/{id}',
            [UserGrowthController::class, 'destroy']
        )->name('user.growth.destroy');


        /*
        |--------------------------------------------------------------------------
        | NUTRISI USER
        |--------------------------------------------------------------------------
        */

        // Form nutrisi
        Route::get(
            '/user/nutrition/create',
            [UserNutritionController::class, 'create']
        )->name('user.nutrition.create');


        // Proses nutrisi
        Route::post(
            '/user/nutrition',
            [UserNutritionController::class, 'store']
        )->name('user.nutrition.store');


        /*
        |--------------------------------------------------------------------------
        | CATATAN DARI ADMIN UNTUK USER
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/user/notes',
            [UserNoteController::class, 'index']
        )->name('user.notes.index');

    });