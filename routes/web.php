<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\KegiatansawahController;
use App\Http\Controllers\KspestisidaController;
use App\Http\Controllers\KspupukController;
use App\Http\Controllers\LokasisawahController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PerkiraancuacaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatpanenController;
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

Route::get('/dashboard', [InfoController::class, 'showperkiraancuaca'])
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

    // IoT
    Route::get('/viewperkiraancuaca', [InfoController::class, 'viewperkiraancuaca'])->name('viewperkiraancuaca');

    // Kegiatan sawah
    Route::get('/viewkegiatansawah', [KegiatansawahController::class, 'index'])->name('viewkegiatansawah');
    Route::get('/addkegiatansawah', [KegiatansawahController::class, 'create'])->name('addkegiatansawah');
    Route::post('/storekegiatansawah', [KegiatansawahController::class, 'store']);
    Route::get('/editkegiatansawah/{id}', [KegiatansawahController::class, 'edit'])->name('editkegiatansawah');
    Route::put('/updatekegiatansawah/{id}', [KegiatansawahController::class, 'update']);
    Route::delete('/deletekegiatansawah/{id}', [KegiatansawahController::class, 'destroy']);

    // Kegiatan Pupuk
    Route::get('/viewkegiatanpupuk', [KspupukController::class, 'index'])->name('viewkegiatanpupuk');
    Route::get('/addkegiatanpupuk', [KspupukController::class, 'create'])->name('addkegiatanpupuk');
    Route::post('/fetch-merkpupuks/{id}',[KsPupukController::class,'fetchMerkpupuks']);
    Route::post('/storekegiatanpupuk', [KspupukController::class, 'store']);
    Route::get('/editkegiatanpupuk/{id}', [KspupukController::class, 'edit'])->name('editkegiatanpupuk');
    Route::put('/updatekegiatanpupuk/{id}', [KspupukController::class, 'update']);
    Route::delete('/deletekegiatanpupuk/{id}', [KspupukController::class, 'destroy']);

    // Kegiatan Pestisida
    Route::get('/viewkegiatanpestisida', [KspestisidaController::class, 'index'])->name('viewkegiatanpestisida');
    Route::get('/addkegiatanpestisida', [KspestisidaController::class, 'create'])->name('addkegiatanpestisida');
    Route::post('/storekegiatanpestisida', [KspestisidaController::class, 'store']);
    Route::get('/editkegiatanpestisida/{id}', [KspestisidaController::class, 'edit'])->name('editkegiatanpestisida');
    Route::put('/updatekegiatanpestisida/{id}', [KspestisidaController::class, 'update']);
    Route::delete('/deletekegiatanpestisida/{id}', [KspestisidaController::class, 'destroy']);

    // Panen
    Route::get('/viewpanen', [PanenController::class, 'index'])->name('viewpanen');
    Route::get('/addpanen/{id}', [PanenController::class, 'create'])->name('addpanen');
    Route::get('/cari', [PanenController::class, 'loaddata'])->name('loaddata');
    Route::post('/storepanen', [PanenController::class, 'store']);
    Route::get('/editpanen/{id}', [PanenController::class, 'edit'])->name('editpanen');
    Route::put('/updatepanen/{id}', [PanenController::class, 'update']);

    // Riwayat Panen
    Route::get('/viewriwayatpanen', [RiwayatpanenController::class, 'index'])->name('viewriwayatpanen');

        
});

require __DIR__.'/auth.php';
