<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\app\DefaultController;
use App\Http\Controllers\app\TestController;
use Src\Employee\Infrastructure\Controllers\EmployeeController;
use Src\Game\Infrastructure\Controllers\GameController;
use Src\Post\Infrastructure\Controllers\JsonPostController;

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

// JSON Post Actions
Route::get('json/post/list/{?title}',       [JsonPostController::class, 'getAllPosts'])->name('json.post.getAllPosts');
Route::get('json/post/show',                [JsonPostController::class, 'findPost'])->name('json.post.findPost');
Route::post('json/post/create',             [JsonPostController::class, 'createPost'])->name('json.post.createPost');
Route::put('json/post/update',              [JsonPostController::class, 'updatePost'])->name('json.post.updatePost');
Route::put('json/post/publishManyPosts',    [JsonPostController::class, 'publishManyPosts'])->name('json.post.publishManyPosts');
Route::delete('json/post/delete',           [JsonPostController::class, 'deletePost'])->name('json.post.deletePost');


/* ---------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------GAMES---------------------------------------------------------- */

// HTTP Post Views
Route::get('game/list/{?title}',    [GameController::class, 'getAllGames'])->name('game.getAllGames');
Route::get('game/show/{id}',        [GameController::class, 'findGame'])->name('game.findGame');
Route::get('game/create',           [GameController::class, 'createForm'])->name('game.createForm');
Route::get('game/edit/{id}',        [GameController::class, 'updateForm'])->name('game.updateForm');
// HTTP Post Actions
Route::post('game/store',           [GameController::class, 'createGame'])->name('game.createGame');
Route::put('game/update',           [GameController::class, 'updateGame'])->name('game.updateGame');
Route::delete('game/delete',        [GameController::class, 'deleteGame'])->name('game.deleteGame');

