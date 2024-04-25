<?php


use App\Http\Controllers\V1\AuthorController;
use App\Http\Controllers\V1\BookController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\GenreController;
use App\Http\Controllers\V1\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'middleware' => 'api'], function (){

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    //genres
    Route::get('/genres', [GenreController::class, 'index'])->name('genre.list');

    //books
    Route::get('/books', [BookController::class, 'index'])->name('book.list');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('book.detail');
    Route::get('/books/search/fast', [BookController::class, 'fastSearch'])->name('book.search.fast');

    //authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('author.list');
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('author.show');

    //need auth
    Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function (){

        //books
        Route::post('/books', [BookController::class, 'store'])->name('book.store');
        Route::post('/books/{id}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/books/{id}', [BookController::class, 'delete'])->name('book.delete');

        //authors
        Route::post('/authors', [AuthorController::class, 'store'])->name('author.store');
        Route::post('/authors/{id}', [AuthorController::class, 'update'])->name('author.update');
        Route::delete('/authors/{id}', [AuthorController::class, 'delete'])->name('author.delete');

    });

});
