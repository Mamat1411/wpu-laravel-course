<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => "Home Page"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => "About"
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title' => "Contact"
    ]);
});

Route::group([
    'as' => 'posts.'
], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/posts?author={user}', [PostController::class, 'index'])->name('authorIndex');
    Route::get('/posts?category={category}', [PostController::class, 'index'])->name('categoryIndex');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
