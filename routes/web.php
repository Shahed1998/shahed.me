<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\dashController;
use App\Http\Controllers\loginController;

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

Route::get('/', [homeController::class, 'getHome'])->name('home');
Route::post('/', [homeController::class, 'postEmail']);
Route::get('/admin/login', [loginController::class, 'getLogin'])->name('login');
Route::post('/admin/login', [loginController::class, 'postLogin']);
Route::get('/admin/dashboard', [dashController::class, 'getDashboard'])->name('dashboard');
// Route::get('/admin/edit', [dashController::class, 'getEdit'])->name('edit');
Route::get('/admin/logout', [dashController::class, 'logout'])->name('logout');