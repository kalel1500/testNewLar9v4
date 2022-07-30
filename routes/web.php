<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\app\DefaultController;
use App\Http\Controllers\app\TestController;
use Src\Employee\Infrastructure\Controllers\EmployeeController;
use Src\Post\Infrastructure\Controllers\JsonPostController;
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


/* ---------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------POSTS---------------------------------------------------------- */

// HTTP Post Views
Route::get('post/getAllPosts',                  [PostController::class, 'getAllPosts'])->name('getAllPosts');
Route::get('post/getPost/{id}',                 [PostController::class, 'getPost'])->name('getPost');
Route::get('post/getPostByCriteria/{title}',    [PostController::class, 'getPostByCriteria'])->name('getPostByCriteria');
Route::get('post/create',                       [PostController::class, 'createForm'])->name('createForm');
Route::get('post/edit/{id}',                    [PostController::class, 'updateForm'])->name('updateForm');
// HTTP Post Actions
Route::post('post/createPost',                  [PostController::class, 'createPost'])->name('createPost');
Route::put('post/updatePost',                   [PostController::class, 'updatePost'])->name('updatePost');
Route::put('post/publishManyPosts',             [PostController::class, 'publishManyPosts'])->name('publishManyPosts');
Route::delete('post/deletePost',                [PostController::class, 'deletePost'])->name('deletePost');


// JSON Post Actions
Route::get('json/post/getAllPosts',             [JsonPostController::class, 'getAllPosts'])->name('json.getAllPosts');
Route::get('json/post/getPost',                 [JsonPostController::class, 'getPost'])->name('json.getPost');
Route::get('json/post/getPostByCriteria',       [JsonPostController::class, 'getPostByCriteria'])->name('json.getPostByCriteria');
Route::post('json/post/createPost',             [JsonPostController::class, 'createPost'])->name('json.createPost');
Route::put('json/post/updatePost',              [JsonPostController::class, 'updatePost'])->name('json.updatePost');
Route::put('json/post/publishManyPosts',        [JsonPostController::class, 'publishManyPosts'])->name('json.publishManyPosts');
Route::delete('json/post/deletePost',           [JsonPostController::class, 'deletePost'])->name('json.deletePost');
