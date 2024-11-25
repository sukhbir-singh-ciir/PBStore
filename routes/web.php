<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    BookController,
    AuthorController,
    GenreController,
    MetaDataController
};

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Books Routes
    Route::resource('books', BookController::class, ['as' => 'admin']);
    
    // Authors Routes
    Route::resource('authors', AuthorController::class, ['as' => 'admin']);
    
    // Genres Routes
    Route::resource('genres', GenreController::class, ['as' => 'admin']);

    Route::resource('metadata', MetaDataController::class, ['as' => 'admin']);
    
    // Upload Routes
    Route::post('books/upload-image', [BookController::class, 'uploadImage'])->name('admin.books.upload-image');
    Route::post('books/upload-file', [BookController::class, 'uploadFile'])->name('admin.books.upload-file');
    Route::post('authors/upload-image', [AuthorController::class, 'uploadImage'])->name('admin.authors.upload-image');
});

require __DIR__.'/auth.php';
