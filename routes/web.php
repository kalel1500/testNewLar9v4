<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use Src\Employee\Infrastructure\Controllers\EmployeeController;

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

Route::get('/', [DefaultController::class, 'default'])->name('default');
Route::get('/tailwind', [DefaultController::class, 'tailwind'])->name('tailwind');
Route::get('/tailwind2', [DefaultController::class, 'tailwind2'])->name('tailwind2');
Route::get('/livewire', [DefaultController::class, 'livewire'])->name('livewire');

Route::get('/employees', [EmployeeController::class, 'list'])->name('list');
