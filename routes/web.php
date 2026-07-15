<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function(){
 Route::resource('posts', PostController::class);
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::get('/read-post', [HomeController::class, 'index'])->name('post');
 Route::get('/post/{post}', [HomeController::class, 'show'])->name('post.show');
});

Route::middleware('auth')->group(function() {
    Route::resource('posts', PostController::class);
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my');
    //
});

Route::get('/admin/dashboard', function (){
    return 'Welcome Admin!';
});

// Admin Dashboard
Route::middleware(['auth','admin'])
        ->prefix('admin')
        ->group(function() {
          
        Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
        });


// Comment Route
Route::resource('comments', CommentController::class)
    ->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard', );
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
