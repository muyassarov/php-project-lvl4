<?php

use App\Http\Controllers\RootController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
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

Route::get('/', [RootController::class, 'index'])->name('root');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('task_statuses', TaskStatusController::class)
    ->middleware('auth');
Route::resource('tasks', TaskController::class)
    ->middleware('auth');
