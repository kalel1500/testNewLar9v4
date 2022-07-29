<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\app\TestController;
use Src\Employee\Infrastructure\Controllers\EmployeeController;
use Src\Post\Infrastructure\Controllers\PostController;

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

// TESTS
//Route::get('/testEloquent', [TestController::class, 'testEloquent'])->name('testEloquent');
//Route::get('/testResponse', [TestController::class, 'testResponse'])->name('testResponse');

Route::get('/', [DefaultController::class, 'default'])->name('default');
Route::get('/tailwind', [DefaultController::class, 'tailwind'])->name('tailwind');
Route::get('/tailwind2', [DefaultController::class, 'tailwind2'])->name('tailwind2');
Route::get('/livewire', [DefaultController::class, 'livewire'])->name('livewire');

Route::get('/employees', [EmployeeController::class, 'list'])->name('list');

Route::get('/getPost',              [PostController::class, 'getPost'])->name('getPost');
Route::get('/getPostByCriteria',    [PostController::class, 'getPostByCriteria'])->name('getPostByCriteria');
Route::post('/createPost',           [PostController::class, 'createPost'])->name('createPost');
Route::put('/updatePost',           [PostController::class, 'updatePost'])->name('updatePost');
Route::put('/publishManyPosts',     [PostController::class, 'publishManyPosts'])->name('publishManyPosts');
Route::delete('/deletePost',           [PostController::class, 'deletePost'])->name('deletePost');
