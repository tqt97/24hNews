<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\HistoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UploadController;

// ******************************** Authentication Admin Routes ****************************************
Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('logout', [LoginController::class, 'logout']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');


// ******************************** Function Admin Routes ****************************************
Route::group(['as' => 'admin.', 'middleware' => ['admin.auth']], function () {

    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::post('upload', [UploadController::class, 'store']);
    Route::delete('upload/delete', [UploadController::class, 'destroy'])->name('destroy');

    // CategoryController
    Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('categories/restore/multiple', [CategoryController::class, 'restoreMultiple'])->name('categories.restore.multiple');
    Route::delete('categories/destroy/multiple', [CategoryController::class, 'destroyMultiple'])->name('categories.destroy.multiple');
    Route::get('categories/destroy/force/{id}', [CategoryController::class, 'forceDestroy'])->name('categories.destroy.force');
    Route::delete('categories/destroy/force/multiple', [CategoryController::class, 'forceDestroyMultiple'])->name('categories.destroy.force.multiple');

    // PostController
    Route::get('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('posts/restore/multiple', [PostController::class, 'restoreMultiple'])->name('posts.restore.multiple');
    Route::delete('posts/destroy/multiple', [PostController::class, 'destroyMultiple'])->name('posts.destroy.multiple');
    Route::get('posts/destroy/force/{id}', [PostController::class, 'forceDestroy'])->name('posts.destroy.force');
    Route::delete('posts/destroy/force/multiple', [PostController::class, 'forceDestroyMultiple'])->name('posts.destroy.force.multiple');

    // AdminController
    Route::get('admins/{id}/restore', [AdminController::class, 'restore'])->name('admins.restore');
    Route::get('admins/restore/multiple', [AdminController::class, 'restoreMultiple'])->name('admins.restore.multiple');
    Route::delete('admins/destroy/multiple', [AdminController::class, 'destroyMultiple'])->name('admins.destroy.multiple');
    Route::get('admins/destroy/force/{id}', [AdminController::class, 'forceDestroy'])->name('admins.destroy.force');
    Route::delete('admins/destroy/force/multiple', [AdminController::class, 'forceDestroyMultiple'])->name('admins.destroy.force.multiple');

    // SliderController
    Route::get('sliders/{id}/restore', [SliderController::class, 'restore'])->name('sliders.restore');
    Route::get('sliders/restore/multiple', [SliderController::class, 'restoreMultiple'])->name('sliders.restore.multiple');
    Route::delete('sliders/destroy/multiple', [SliderController::class, 'destroyMultiple'])->name('sliders.destroy.multiple');
    Route::get('sliders/destroy/force/{id}', [SliderController::class, 'forceDestroy'])->name('sliders.destroy.force');
    Route::delete('sliders/destroy/force/multiple', [SliderController::class, 'forceDestroyMultiple'])->name('sliders.destroy.force.multiple');


    Route::prefix('categories')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('categories.index')->middleware('can:category-read');
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create')->middleware('can:category-create');
        Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('can:category-update');
        Route::put('update/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('can:category-delete');
    });
    // Route::resource('category', CategoryController::class);

    // Route::prefix('post')->group(function () {
    //     Route::get('', [PostController::class, 'index'])->name('post.index');
    //     Route::get('create', [PostController::class, 'create'])->name('post.create');
    //     Route::post('store', [PostController::class, 'store'])->name('post.store');
    //     Route::get('edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    //     Route::put('update/{post}', [PostController::class, 'update'])->name('post.update');
    //     Route::delete('destroy/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    // });
    // Route::resource('post', PostController::class);
    Route::get('history', [HistoryController::class, 'index'])->name('history.index');



    Route::resources([
        'categories' => CategoryController::class,
        'posts' => PostController::class,
        'tags' => TagController::class,
        'admins' => AdminController::class,
        'roles' => RoleController::class,
        'sliders' => SliderController::class,
    ]);

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
        Route::post('store', [PermissionController::class, 'store'])->name('permissions.store');
    });
    Route::prefix('profiles')->group(function () {
        Route::get('edit/{id}', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::put('update/{id}', [ProfileController::class, 'updateInformation'])->name('profiles.update.information');
        Route::put('image/{id}', [ProfileController::class, 'updateImage'])->name('profiles.update.image');
        Route::put('password/{id}', [ProfileController::class, 'updatePassword'])->name('profiles.update.password');
    });
    Route::prefix('comments')->group(function () {
        Route::get('', [CommentController::class, 'index'])->name('comments.index');
        Route::get('edit/{comment}', [CommentController::class, 'edit'])->name('comments.edit');
        Route::put('update/{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('delete/{comment}', [CommentController::class, 'delete'])->name('comments.destroy');
    });

    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
        Route::delete('delete/{contact}', [ContactController::class, 'delete'])->name('contacts.destroy');
    });

    // Route::prefix('user')->group(function () {
    //     Route::get('', [UserController::class, 'index'])->name('user.index');
    //     Route::get('create', [UserController::class, 'create'])->name('user.create');
    //     Route::post('store', [UserController::class, 'store'])->name('user.store');
    //     Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    //     Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
    //     Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    // });
});
