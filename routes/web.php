<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicTopController;
use App\Http\Controllers\PublicPostController;
use App\Http\Controllers\PublicCommentController;
use App\Http\Controllers\PublicGalleryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
    Route::delete('post/{post}/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

Route::get('public/top',[PublicTopController::class,'top'])->name('public.top');
Route::get('public/post',[PublicPostController::class,'index'])->name('public.post.index');
Route::get('public/gallery',[PublicGalleryController::class,'gallery'])->name('public.gallery');
Route::get('public/post/{post}',[PublicPostController::class,'show'])->name('public.post.show');
Route::post('public/post/{post}/comment',[PublicCommentController::class,'store'])->name('public.post.comment');

require __DIR__.'/settings.php';