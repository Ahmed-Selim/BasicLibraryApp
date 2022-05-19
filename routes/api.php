<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Models\Language;
use App\Models\Category;
use App\Http\Controllers\BorrowController;
use App\Models\User;

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

Route::get('users/{user}', function (User $user) {
    return response()->json($user, 200);
});

Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'index');
    Route::get('/authors/{author}', 'show');
    Route::post('/authors', 'store');
    Route::put('/authors/{author}', 'update');
    Route::delete('/authors/{author}', 'destroy');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index');
    Route::get('/books/{book}', 'show');
    Route::post('/books', 'store');
    Route::put('/books/{book}', 'update');
    Route::delete('/books/{book}', 'destroy');
});

Route::controller(BorrowController::class)->group(function () {
    Route::get('/borrows', 'index');
    Route::get('/borrows/{borrow}', 'show');
    Route::post('/borrows', 'store');
    Route::put('/borrows/{borrow}', 'update');
    Route::delete('/borrows/{borrow}', 'destroy');
});


Route::prefix('languages')->group(function () {
    Route::get('', function () {
        return response()->json(Language::all(), 200);
    });
    Route::get('{language}', function (Language $language) {
        return response()->json($language, 200);
    });
});

Route::prefix('categories')->group(function () {
    Route::get('', function () {
        return response()->json(Category::all(), 200);
    });
    Route::get('{category}', function (Category $category) {
        return response()->json($category, 200);
    });
});