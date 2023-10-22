<?php

use App\Models\Frequently;
use App\Http\Controllers\Navi;
use App\Http\Controllers\Admin;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FloorplanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\FrequentlyController;
use App\Http\Controllers\FunctionalityController;
use App\Http\Controllers\UpdateController;

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

    // facilites
    Route::get('/facilities', [FacilityController::class, 'facilities'])->name('admin.facilities');
    Route::post('/facilities-manage', [FacilityController::class, 'facilitiesManage'])->name('bulk.manage.facilities');

    // dynamic table content
    Route::get('/tables', [TableController::class, 'tables'])->name('admin.table');

    // building layout
    Route::get('/building-layouts',[FloorplanController::class, 'floorPlanLayout'])->name('admin.building.layouts');
    // send coordinates to server
    Route::post('/building-layouts/coordinates',[FloorplanController::class, 'floorPlanLayoutSave'])->name('admin.building.layouts.save');
    Route::get('/coordinates',[FloorplanController::class, 'floorPlanLayoutGet'])->name('admin.building.layouts.get');

    // get updates
    Route::get('/updates',[UpdateController::class,'getUpdates']);
    Route::get('/initialize-updates',[UpdateController::class,'updatedSystem'])->name('admin.updates');

    // functionality
    Route::get('/functionality',[FunctionalityController::class,'manage'])->name('func.manage');
    Route::post('/functionality-updates',[FunctionalityController::class,'update'])->name('func.update');
});

// navi route
Route::get('/navi',[Navi::class, 'startNaviServer'])->name('navi.server');
Route::post('/navi/process',[Navi::class, 'naviProcess'])->name('navi.server.process');
Route::post('/navi/process/information',[Navi::class, 'naviProcessInformationRequest'])->name('navi.server.process.information');
Route::post('/navi/process/search',[Navi::class, 'naviProcessInformationSearch'])->name('navi.server.process.search');
Route::post('/navi/process/navigation',[Navi::class, 'naviProcessNavigation'])->name('navi.server.process.navigation');



require __DIR__.'/auth.php';
