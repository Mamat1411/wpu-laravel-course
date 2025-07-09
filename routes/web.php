<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDashboardController;
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
    'prefix' => '/posts',
    'as' => 'posts.'
], function () {
    Route::get('', [PostController::class, 'index'])->name('index');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('?author={user}', [PostController::class, 'index'])->name('authorIndex');
    Route::get('?category={category}', [PostController::class, 'index'])->name('categoryIndex');
});

Route::group([
    'middleware' => [
        'auth',
        'verified'
    ]
], function () {
    Route::group([
        'prefix' => '/dashboard',
        'as' => 'dashboard.'
    ], function () {
        Route::get('', [PostDashboardController::class, 'index'])->name('index');
        Route::get('/create', [PostDashboardController::class, 'create'])->name('create');
        Route::post('', [PostDashboardController::class, 'store'])->name('store');
        Route::get('/{post}', [PostDashboardController::class, 'show'])->name('show');
        Route::get('/edit/{post}', [PostDashboardController::class, 'edit'])->name('edit');
        Route::put('/update/{post}', [PostDashboardController::class, 'update'])->name('update');
        Route::delete('/delete/{post}', [PostDashboardController::class, 'destroy'])->name('delete');
    });

    Route::group([
        'prefix' => '/profile',
        'as' => 'profile.'
    ], function () {
        Route::get('', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('', [ProfileController::class, 'update'])->name('update');
        Route::delete('', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
