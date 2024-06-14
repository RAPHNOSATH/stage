<?php

use App\Http\Controllers\AcceuilController;
use App\Http\Controllers\Gestion\GestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Suivi\SuiviController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AcceuilController::class,'home'])->name('/');
Route::get('/gestion/index',[GestionController::class,'index'])->name('gestion.index');
Route::get('/suivi/index',[SuiviController::class,'index'])->name('suivi.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
