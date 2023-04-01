<?php

use App\Http\Controllers\KegiatansawahController;
use App\Http\Controllers\KspestisidaController;
use App\Http\Controllers\LokasisawahController;
use App\Http\Controllers\pendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [LokasisawahController::class, 'showcuaca'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Lokasi sawah
    Route::get('/viewlokasisawah', [LokasisawahController::class, 'index'])->name('viewlokasisawah');
    Route::get('/addlokasisawah', [LokasisawahController::class, 'create'])->name('addlokasisawah');
    Route::post('/storelokasisawah', [LokasisawahController::class, 'store']);
    Route::get('/editlokasisawah/{id}', [LokasisawahController::class, 'edit'])->name('editlokasisawah');
    Route::put('/updatelokasisawah/{id}', [LokasisawahController::class, 'update']);
    Route::delete('/deletelokasisawah/{id}', [LokasisawahController::class, 'destroy']);

    // Kegiatan sawah
    Route::get('/viewkegiatansawah', [KegiatansawahController::class, 'index'])->name('viewkegiatansawah');
    Route::get('/addkegiatansawah', [KegiatansawahController::class, 'create'])->name('addkegiatansawah');
    Route::post('/storekegiatansawah', [KegiatansawahController::class, 'store']);
    Route::get('/editkegiatansawah/{id}', [KegiatansawahController::class, 'edit'])->name('editkegiatansawah');
    Route::put('/updatekegiatansawah/{id}', [KegiatansawahController::class, 'update']);
    Route::delete('/deletekegiatansawah/{id}', [KegiatansawahController::class, 'destroy']);

    // Kegiatan Pestisida
    Route::get('/viewkegiatanpestisida', [KspestisidaController::class, 'index'])->name('viewkegiatanpestisida');
    Route::get('/addkegiatanpestisida', [KspestisidaController::class, 'create'])->name('addkegiatanpestisida');
    Route::post('/storekegiatanpestisida', [KspestisidaController::class, 'store']);
    Route::get('/editkegiatanpestisida/{id}', [KspestisidaController::class, 'edit'])->name('editkegiatanpestisida');
    Route::put('/updatekegiatanpestisida/{id}', [KspestisidaController::class, 'update']);
    Route::delete('/deletekegiatanpestisida/{id}', [KspestisidaController::class, 'destroy']);
        
});

require __DIR__.'/auth.php';
