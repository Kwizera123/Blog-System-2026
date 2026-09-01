<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\BlogProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\TutorialController as FrontendTutorialController;
use App\Http\Controllers\Admin\TutorialController as AdminTutorialController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\DashboardController as FrontendDashboardController;




/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Visitors can access these routes without logging in.
|
*/

Route::get('/', [HomeController::class, 'index'])
        ->name('home');

Route::get('/blog', [BlogController::class, 'index'])
        ->name('blog.index');

Route::get('/tutorials', [FrontendTutorialController::class, 'index'])
        ->name('tutorials.index');

Route::get('/tutorials/{tutorial:slug}', [FrontendTutorialController::class, 'show'])
        ->name('tutorials.show');

Route::get('/about', [PageController::class, 'about'])
        ->name('about');
Route::get('/contact', [PageController::class, 'contact'])
        ->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])
        ->name('contact.store');


  Route::get('/post/{post}', [HomeController::class, 'show'])
       ->name('post.show');
/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
|
| Users must log in before accessing these routes.
|
*/

Route::middleware('auth')->group(function(){

 // Post Management
 Route::resource('posts', PostController::class);


   Route::get('/my-posts', [PostController::class, 'myPosts'])
                ->name('posts.my');

   // Blog Profile
   Route::get('/blogprofile', [BlogProfileController::class, 'index'])
        ->name('blogprofile.index');

Route::Patch('/blogprofile', [BlogProfileController::class, 'update'])
        ->name('blogprofile.update');

Route::delete('blogprofile/photo', [BlogProfileController::class, 'destroyPhoto'])
        ->name('blogprofile.photo.destroy');

Route::patch('/profile/password', [BlogProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

// Comments
Route::resource('comments', CommentController::class);

Route::get('/dashboard', function () {
    return view('dashboard', );
})
        ->middleware('verified')
        ->name('dashboard');

// Default Laravel Profile
 Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
 Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
 Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Only users whose role is "admin" can access these routes.
|
*/
Route::middleware(['auth','role:admin'])
        ->prefix('admin')
        ->group(function() {


         Route::get('/admin/dashboard', [DashboardController::class, 'index'])
                        ->name('admin.dashboard'); 

        // Admin Comment Management
        Route::get('/admin/comments', [CommentController::class, 'adminIndex'])
                        ->name('admin.comments.index');

        Route::delete('/admin/comments/{comment}', [CommentController::class, 'adminDestroy'])
                        ->name('admin.comments.destroy');

        Route::patch('/admin/comments/{comment}/approve', [CommentController::class, 'approve'])
                        ->name('admin.comments.approve');
                
        Route::patch('/admin/comments/{comment}/hide', [CommentController::class, 'hide'])
                        ->name('admin.comments.hide');
        // Admin User Management
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
        
        // Admin Category Management
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

        // Publish and Unpublish Posts
         Route::patch('/admin/posts/{post}/publish', [PostController::class, 'publish'])
                        ->name('admin.posts.publish');

        Route::patch('/admin/posts/{post}/unpublish', [PostController::class, 'unpublish'])
                        ->name('admin.posts.unpublish');

        // Admin Tag Management
         Route::resource('tags', TagController::class)
                        ->names('admin.tags');

        //Admin Tutorial Controller
        Route::resource('tutorials', AdminTutorialController::class)
                ->names('admin.tutorials');

        // Admin About Page Management
        Route::get('/about', [AdminAboutController::class, 'index'])
                ->name('admin.about.index');

        Route::get('/about/edit', [AdminAboutController::class, 'edit'])
                ->name('admin.about.edit');

        Route::put('/about', [AdminAboutController::class, 'update'])
                ->name('admin.about.update');

        Route::get('/about/items/{aboutItem}/edit', [AdminAboutController::class, 'editItem'])
                ->name('admin.about.items.edit');

        Route::put('/about/items/{aboutItem}', [AdminAboutController::class, 'updateItem'])
                ->name('admin.about.items.update');

        Route::get('/about/items/create', [AdminAboutController::class, 'createItem'])
                ->name('admin.about.items.create');

        Route::post('/about/items', [AdminAboutController::class, 'storeItem'])
                 ->name('admin.about.items.store');

        Route::delete('/about/items/{aboutItem}', [AdminAboutController::class, 'destroyItem'])
                ->name('admin.about.items.destroy');
        // Sorting
        Route::patch('/about/items/{aboutItem}/move-up', [AdminAboutController::class, 'moveUp'])
                 ->name('admin.about.items.moveUp');

        Route::patch('/about/items/{aboutItem}/move-down', [AdminAboutController::class, 'moveDown'])
                 ->name('admin.about.items.moveDown'); 

        Route::get('/contact-messages', [ContactMessageController::class, 'index'])
                 ->name('admin.contact-messages.index');

        Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])
                 ->name('admin.contact-messages.show');

        Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])
                 ->name('admin.contact-messages.destroy');

       });


//   Route::get('/read-post', [HomeController::class, 'index'])->name('post');

require __DIR__.'/auth.php';
