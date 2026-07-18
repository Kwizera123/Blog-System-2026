<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\CategoryController;

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

                Route::get('/users', [UserController::class, 'index'])
                        ->name('admin.users.index');

                Route::get('/users/{user}', [UserController::class, 'show'])
                        ->name('admin.users.show');

                Route::get('/users/{user}/edit', [UserController::class, 'edit'])
                        ->name('admin.users.edit');

                Route::put('/users/{user}', [UserController::class, 'update'])
                        ->name('admin.users.update');

                Route::delete('/users/{user}', [UserController::class, 'destroy'])
                        ->name('admin.users.destroy');

                // Categories Routes
                 Route::get('/categories', [CategoryController::class, 'index'])
                        ->name('admin.categories.index'); 
                
                Route::get('/categories/create', [CategoryController::class, 'create'])
                        ->name('admin.categories.create');
                        
                Route::post('/categories', [CategoryController::class, 'store'])
                        ->name('admin.categories.store');




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
