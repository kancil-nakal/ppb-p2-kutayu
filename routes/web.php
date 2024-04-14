<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WajibPajakController;
use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\MasterPenarikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return redirect('/admin');
})->middleware(['auth', 'verified']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin',[DashboardControler::class, 'index'] )->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('setoran', [SetoranController::class, 'index'])->name('setoran.index');
    Route::post('setoran', [SetoranController::class, 'store'])->name('setoran.store');
    Route::get('setoran/getdatabysppt', [SetoranController::class, 'getdatabysppt'])->name('setoran.__getSPPT');
    Route::get('rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('rekap/export', [RekapController::class, 'export'])->name('rekap.export');
    Route::get('/wajibpajak/import', [WajibPajakController::class, 'import'])->name('wajibpajak.import');
    Route::post('/wajibpajak/import', [WajibPajakController::class, 'import_data'])->name('wajibpajak.import_data');
    Route::get('/wajibpajak/export', [WajibPajakController::class, 'export'])->name('wajibpajak.export');
    Route::get('/wajibpajak/json', [WajibPajakController::class, 'data'])->name('wajibpajak.data');
    Route::resource('wajibpajak', WajibPajakController::class);
    Route::get('/penarik', [MasterPenarikController::class, 'index'])->name('penarik.index');
    Route::post('/penarik/import', [MasterPenarikController::class, 'import'])->name('penarik.import');
    Route::resource('users', UserController::class);

    Route::get('/download/templatepbb', [DownloadController::class, 'template_pbb'])->name('download.templatepbb');
    Route::get('/download/templatemaster', [DownloadController::class, 'template_master'])->name('download.templatemaster');
});

require __DIR__.'/auth.php';
