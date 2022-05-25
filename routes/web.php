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
Route::put('/admin/dashboard', [dashController::class, 'updateProfile'])->middleware('xss-sanitizer');

Route::get('/admin/logout', [dashController::class, 'logout'])->name('logout');

Route::get('/admin/messages', [dashController::class, 'getMessages'])->name('messages');
Route::get('/admin/messages/new', [dashController::class, 'getNewMessages'])->name('newMessages');
Route::get('/admin/messages/deleteAll', [dashController::class, 'deleteAllMessages'])->name("dltAllMsg");
Route::get('/admin/messages/delete/{id}', [dashController::class, 'dltOneMsg'])->name('dltOneMsg');
Route::get('/admin/messages/{id}', [dashController::class, 'viewOneMsg'])->name('viewOnePage');
Route::post('/admin/messages/{id}', [dashController::class, 'sendMail']);

Route::get('/admin/projects', [dashController::class, 'getProjects'])->name('projects');
Route::get('/admin/projects/add', [dashController::class,'addNewProject'])->name('newProject');
Route::post('/admin/projects/add', [dashController::class,'postNewProject']);
Route::get('/admin/projects/{id}', [dashController::class, 'deleteProject'])->name('deleteProject');
Route::get('/admin/projects/edit/{id}', [dashController::class,'editProject'])->name('editProject');
Route::put('/admin/projects/edit/{id}', [dashController::class,'putEditProject']);