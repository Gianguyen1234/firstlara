<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('layout');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class);

// routes/web.php
Route::post('/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');


// add route middleware for usertype
Route::middleware(['auth', 'usertype:admin'])->group(function () {
    // Admin dashboard routes
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/analytics', [AdminController::class, 'showAnalytics'])->name('admin.analytics');
    
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create'); // Show create form
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store'); // Handle form submit (create)   
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit'); // Show edit form
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    //manage posts
    Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.delete');


});

Route::middleware(['auth', 'usertype:user'])->group(function () {
    // Routes for regular users to create posts
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
   
});

// Route to show uncategorized posts
Route::get('/category/uncategorized', [CategoryController::class, 'showUncategorized'])->name('category.uncategorized');


// Route::get('/category/{id}', [CategoryController::class, 'showCategoryPosts'])->name('category.posts');
Route::get('/category/{slug}', [CategoryController::class, 'showCategoryPosts'])->name('category.posts');
//show the post through category
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('post.show');

// Comments related to a specific post identified by slug
Route::get('/posts/{slug}/comments', [CommentController::class, 'index'])->name('comments.index'); // List all comments for a specific post
Route::get('/posts/{slug}/comments/create', [CommentController::class, 'create'])->name('comments.create'); // Create a new comment form (if needed)
Route::get('/posts/{slug}/comments/{id}', [CommentController::class, 'show'])->name('comments.show'); // Show a specific comment related to the post
Route::post('/posts/{slug}/comments', [CommentController::class, 'store'])->name('comments.store'); 

//upvote comment
Route::post('comments/{id}/upvote', [CommentController::class, 'upvote'])->name('comments.upvote');


require __DIR__.'/auth.php';
