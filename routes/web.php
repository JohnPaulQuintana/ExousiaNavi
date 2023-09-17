<?php

use App\Models\Frequently;
use App\Http\Controllers\Navi;
use App\Http\Controllers\Admin;
use App\Http\Controllers\FloorplanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\FrequentlyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.contents');
});

Route::get('/dashboard', [Admin::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // frequently ask
    Route::get('/frequently',[FrequentlyController::class,'frequently'])->name('admin.frequently');
    Route::post('/frequently-manage',[FrequentlyController::class,'frequentlyManage'])->name('bulk.manage.frequently');

    // teachers
    Route::get('/teachers', [TeacherController::class, 'teachers'])->name('admin.teachers');
    Route::post('/teachers-manage', [TeacherController::class, 'teachersManage'])->name('bulk.manage.teachers');

    // dynamic table content
    Route::get('/tables', [TableController::class, 'tables'])->name('admin.table');

    // building layout
    Route::get('/building-layouts',[FloorplanController::class, 'floorPlanLayout'])->name('admin.building.layouts');
    // send coordinates to server
    Route::post('/building-layouts/coordinates',[FloorplanController::class, 'floorPlanLayoutSave'])->name('admin.building.layouts.save');
    Route::get('/coordinates',[FloorplanController::class, 'floorPlanLayoutGet'])->name('admin.building.layouts.get');
});

// navi route
Route::get('/navi',[Navi::class, 'startNaviServer'])->name('navi.server');
Route::post('/navi/process',[Navi::class, 'naviProcess'])->name('navi.server.process');
Route::post('/navi/process/navigation',[Navi::class, 'naviProcessNavigation'])->name('navi.server.process.navigation');



require __DIR__.'/auth.php';
