<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

Route::get('/', [HomeController::class, 'index'])
->name('home');
//Route::get('/', [CategoryController::class, 'index'])
//->name('home');

Route::middleware('auth')->group(function(){
 Route::resource('posts', PostController::class);
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::get('/read-post', [HomeController::class, 'index'])->name('post');
 Route::get('/post/{post}', [HomeController::class, 'show'])
        ->name('post.show');



});

Route::middleware('auth')->group(function() {
    Route::resource('posts', PostController::class);

    Route::get('/posts/{$slug}', [PostController::class, 'show'])
                ->name('posts.show');

    Route::get('/my-posts', [PostController::class, 'myPosts'])
                ->name('posts.my');
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

                Route::get('/admin/dashboard', [DashboardController::class, 'index'])
                        ->name('admin.dashboard');  
                Route::get('/admin/comments', [CommentController::class, 'adminIndex'])
                        ->name('admin.comments.index');

                Route::delete('/admin/comments/{comment}', [CommentController::class, 'adminDestroy'])
                        ->name('admin.comments.destroy');

                Route::patch('/admin/comments/{comment}/approve', [CommentController::class, 'approve'])
                        ->name('admin.comments.approve');
                
                Route::patch('/admin/comments/{comment}/hide', [CommentController::class, 'hide'])
                        ->name('admin.comments.hide');

                

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

                Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
                        ->name('admin.categories.edit');

                Route::put('/categories/{category}', [CategoryController::class, 'update'])
                        ->name('admin.categories.update');
                
                Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
                        ->name('admin.categories.destroy');

                Route::patch('/admin/posts/{post}/publish', [PostController::class, 'publish'])
                        ->name('admin.posts.publish');

                Route::patch('/admin/posts/{post}/unpublish', [PostController::class, 'unpublish'])
                        ->name('admin.posts.unpublish');
                //Tag
                Route::resource('tags', TagController::class)
                        ->names('admin.tags');
                // 
        });

        // Route::middleware(['auth', 'admin'])->group(function () {

        //         Route::get('/admin/dashboard', [AdminController::class, 'index'])
        //                 ->name('admin.dashboard');  
        //         Route::get('/admin/comments', [CommentController::class, 'adminIndex'])
        //                 ->name('admin.comments.index');
        //         });

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
