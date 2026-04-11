<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('posts.index');
/*

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

require __DIR__.'/auth.php';

/*
Route::get('/posts', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->middleware(['auth', 'verified'])->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->middleware(['auth', 'verified'])->name('posts.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware(['auth', 'verified'])->name('posts.edit');

Route::patch('/posts/{post}', [PostController::class, 'update'])->middleware(['auth', 'verified'])->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware(['auth', 'verified'])->name('posts.destroy');
*/

Route::resource('posts', PostController::class)->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');      // ← ここを追加
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');      // ← 更新用も必要なら追加
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');   // ← 新規作成用ルート追加
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');            // ← 新規保存用ルート追加
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');   // ←プロフィール
    Route::post('/bookmark/{post}', [BookmarkController::class, 'store'])->name('bookmark.store');  //←ブックマーク追加
    Route::delete('/bookmark/{post}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');  // ブックマーク削除  
    Route::get('/bookmarks', [App\Http\Controllers\BookmarkController::class, 'index'])->name('bookmarks.index'); // ブックマーク一覧
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store'); // ← コメントルート追加
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy');
 
});

