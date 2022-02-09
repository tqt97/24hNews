<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

// ******************************** Authentication Admin Routes ****************************************
Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('logout', [LoginController::class, 'logout']); // @Todo Remove logout GET method

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');


// ******************************** Function Admin Routes ****************************************
Route::group(['as' => 'admin.', 'middleware' => ['admin.auth']], function () {
    // Route::middleware('admin.auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('category')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('category.index')->middleware('can:category-read');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create')->middleware('can:category-create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('can:category-edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('can:category-delete');
    });
    // Route::resource('category', CategoryController::class);

    // Route::prefix('post')->group(function () {
    //     Route::get('', [PostController::class, 'index'])->name('post.index');
    //     Route::get('create', [PostController::class, 'create'])->name('post.create');
    //     Route::post('store', [PostController::class, 'store'])->name('post.store');
    //     Route::get('edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    //     Route::put('update/{id}', [PostController::class, 'update'])->name('post.update');
    //     Route::get('destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    // });
    // Route::resource('post', PostController::class);

    Route::resources([
        // 'category' => CategoryController::class,
        'post' => PostController::class,
        'tag' => TagController::class,
        'user' => UserController::class,
        'role' => RoleController::class,
    ]);

    Route::prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        // Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('store', [PermissionController::class, 'store'])->name('permission.store');
    });

    // Route::prefix('comment')->group(function () {
    //     Route::get('', [CommentController::class, 'index'])->name('comment.index');
    //     Route::get('edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    //     Route::put('update/{id}', [CommentController::class, 'update'])->name('comment.update');
    //     Route::get('delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
    // });

    // Route::prefix('contact')->group(function () {
    //     Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    //     Route::get('delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
    // });

    // Route::prefix('user')->group(function () {
    //     Route::get('', [UserController::class, 'index'])->name('user.index');
    //     Route::get('create', [UserController::class, 'create'])->name('user.create');
    //     Route::post('store', [UserController::class, 'store'])->name('user.store');
    //     Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    //     Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
    //     Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    // });
});
