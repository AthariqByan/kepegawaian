<?php

use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\PegawaiController;
use App\Models\Posisi;

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
    return view('auth.login');
});

//route login dan register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register_proses', [LoginController::class, 'register_proses'])->name('register_proses');


//Route untuk admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'showAdmin'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'showUsers'])->name('users.index');
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/posisi', PosisiController::class);
    Route::delete('/admin/posisi/{id}', [PosisiController::class, 'destroy'])->name('admin.posisi.destroy');
});
