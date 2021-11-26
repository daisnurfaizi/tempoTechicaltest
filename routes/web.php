<?php

use App\Http\Controllers\AuthCheck;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Pengguna;
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

Route::get('/', [Pengguna::class, 'ListPengguna'])->name('list');
Route::get('tambah_pengguna', [Pengguna::class, 'tambahPengguna'])->name('tambahpengguna');
Route::post('save', [Pengguna::class, 'save']);
Route::post('editdata', [Pengguna::class, 'update']);
Route::get('editpengguna/{login}', [Pengguna::class, 'edit'])->name('edit');
Route::get('delete/{login}', [Pengguna::class, 'delete']);
Route::post('/home', [AuthCheck::class, 'AuthCheck']);
Route::get('Dashboard', [HomeController::class, 'home'])->middleware('ceklogin');
Route::get('/login', [HomeController::class, 'index']);
Route::get('/logout', [AuthCheck::class, 'logout']);
