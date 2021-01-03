<?php

use App\Http\Controllers\{LabelController, RootController, TaskController, TaskStatusController};
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

Route::resources([
    'tasks' => TaskController::class,
    'task_statuses' => TaskStatusController::class,
    'labels' => LabelController::class,
]);
