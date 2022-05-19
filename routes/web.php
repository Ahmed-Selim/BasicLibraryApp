<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::controller(AuthorController::class)->group(function () {
        Route::get('/authors', 'index')->name('author.index');
        Route::get('/authors/{author}', 'show')->name('author.show');
        Route::post('/authors', 'store')->name('author.store');
        Route::put('/authors/{author}', 'update')->name('author.update');
        Route::delete('/authors/{author}', 'destroy')->name('author.destroy');
    });
    
    Route::controller(BookController::class)->group(function () {
        Route::get('/books', 'index')->name('book.index');
        Route::get('/books/{book}', 'show')->name('book.show');
        Route::post('/books', 'store')->name('book.store');
        Route::put('/books/{book}', 'update')->name('book.update');
        Route::delete('/books/{book}', 'destroy')->name('book.destroy');
    });
    
    Route::controller(BorrowController::class)->group(function () {
        Route::get('/borrows', 'index')->name('borrow.index');
        Route::get('/borrows/{borrow}', 'show')->name('borrow.show');
        Route::post('/borrows', 'store')->name('borrow.store');
        Route::put('/borrows/{borrow}', 'update')->name('borrow.update');
        Route::delete('/borrows/{borrow}', 'destroy')->name('borrow.destroy');
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
});
