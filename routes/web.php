<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return redirect()->route('post.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('post',[PostController::class,'index'])->name('post.index');
    Route::get('post/create',[PostController::class,'create'])->name('post.create');
    Route::post('post',[PostController::class,'store'])->name('post.store');
    Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});
require __DIR__.'/settings.php';