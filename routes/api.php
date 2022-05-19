<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'index');
    Route::get('/authors/{author}', 'show');
    Route::put('/authors/{author}', 'update');
    Route::delete('/authors/{author}', 'destroy');
    Route::post('/authors', 'store');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index');
    Route::get('/books/{book}', 'show');
    Route::post('/books', 'store');
});