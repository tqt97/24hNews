<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\HistoryController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UploadController;


Route::group(['as' => 'admin.', 'middleware' => ['admin.auth']], function () {

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('upload')->group(function () {
        Route::post('', [UploadController::class, 'store']);
        Route::delete('delete', [UploadController::class, 'destroy'])->name('destroy');
    });

    Route::controller(UploadController::class)
        ->prefix('upload')
        ->as('upload.')
        ->group(function () {
            Route::post('',  'store');
            Route::delete('delete',  'destroy')->name('destroy');
        });

    Route::controller(CategoryController::class)
        ->prefix('categories')
        ->as('categories.')
        ->group(function () {
            Route::get('restore/multiple',  'restoreMultiple')->name('restore.multiple');
            Route::get('restore/{id}',  'restore')->name('restore');
            Route::delete('destroy/multiple',  'destroyMultiple')->name('destroy.multiple');
            Route::get('destroy/force/{id}',  'forceDestroy')->name('destroy.force');
            Route::delete('destroy/force/multiple',  'forceDestroyMultiple')->name('destroy.force.multiple');

            Route::get('', 'index')->name('index'); //->middleware('can:category-read');
            Route::get('create', 'create')->name('create'); //->middleware('can:category-create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{category}', 'edit')->name('edit'); //->middleware('can:category-update');
            Route::put('update/{category}', 'update')->name('update');
            Route::delete('destroy/{category}', 'destroy')->name('destroy'); //->middleware('can:category-delete');
        });

    Route::controller(PostController::class)
        ->prefix('posts')
        ->as('posts.')
        ->group(function () {
            Route::get('restore/multiple',  'restoreMultiple')->name('restore.multiple');
            Route::get('restore/{id}',  'restore')->name('restore');
            Route::delete('destroy/multiple',  'destroyMultiple')->name('destroy.multiple');
            Route::get('destroy/force/{id}',  'forceDestroy')->name('destroy.force');
            Route::delete('destroy/force/multiple',  'forceDestroyMultiple')->name('destroy.force.multiple');

            Route::get('',  'index')->name('index'); //->middleware('can:category-read');
            Route::get('create',  'create')->name('create'); //->middleware('can:category-create');
            Route::post('store',  'store')->name('store');
            Route::get('edit/{post}',  'edit')->name('edit'); //->middleware('can:category-update');
            Route::put('update/{post}',  'update')->name('update');
            Route::delete('destroy/{post}',  'destroy')->name('destroy'); //->middleware('can:category-delete');
        });

    Route::controller(AdminController::class)
        ->prefix('admins')
        ->as('admins.')
        ->group(function () {
            Route::get('restore/multiple',  'restoreMultiple')->name('restore.multiple');
            Route::get('restore/{id}',  'restore')->name('restore');
            Route::delete('destroy/multiple',  'destroyMultiple')->name('destroy.multiple');
            Route::get('destroy/force/{id}',  'forceDestroy')->name('destroy.force');
            Route::delete('destroy/force/multiple',  'forceDestroyMultiple')->name('destroy.force.multiple');

            Route::get('',  'index')->name('index'); //->middleware('can:category-read');
            Route::get('create',  'create')->name('create'); //->middleware('can:category-create');
            Route::post('store',  'store')->name('store');
            Route::get('edit/{admin}',  'edit')->name('edit'); //->middleware('can:category-update');
            Route::put('update/{admin}',  'update')->name('update');
            Route::delete('destroy/{admin}',  'destroy')->name('destroy'); //->middleware('can:category-delete');
        });

    Route::controller(SliderController::class)
        ->prefix('sliders')
        ->as('sliders.')
        ->group(function () {
            Route::get('restore/multiple',  'restoreMultiple')->name('restore.multiple');
            Route::get('restore/{id}',  'restore')->name('restore');
            Route::delete('destroy/multiple',  'destroyMultiple')->name('destroy.multiple');
            Route::get('destroy/force/{id}',  'forceDestroy')->name('destroy.force');
            Route::delete('destroy/force/multiple',  'forceDestroyMultiple')->name('destroy.force.multiple');

            Route::get('',  'index')->name('index'); //->middleware('can:category-read');
            Route::get('create',  'create')->name('create'); //->middleware('can:category-create');
            Route::post('store',  'store')->name('store');
            Route::get('edit/{slider}',  'edit')->name('edit'); //->middleware('can:category-update');
            Route::put('update/{slider}',  'update')->name('update');
            Route::delete('destroy/{slider}',  'destroy')->name('destroy'); //->middleware('can:category-delete');
        });







    Route::resources([
        'tags' => TagController::class,
        'roles' => RoleController::class,
    ]);


    Route::controller(PermissionController::class)
        ->prefix('permissions')
        ->as('permissions.')
        ->group(function () {
            Route::get('/',  'index')->name('index');
            Route::post('store',  'store')->name('store');
        });

    Route::controller(ProfileController::class)
        ->prefix('profiles')
        ->as('profiles.')
        ->group(function () {
            Route::get('edit/{id}',  'edit')->name('edit');
            Route::put('update/{id}',  'updateInformation')->name('update.information');
            Route::put('image/{id}',  'updateImage')->name('update.image');
            Route::put('password/{id}',  'updatePassword')->name('update.password');
        });

    Route::controller(CommentController::class)
        ->prefix('comments')
        ->as('comments.')
        ->group(function () {
            Route::get('',  'index')->name('index');
            Route::get('edit/{comment}',  'edit')->name('edit');
            Route::put('update/{comment}',  'update')->name('update');
            Route::delete('delete/{comment}',  'delete')->name('destroy');
        });

    Route::controller(ContactController::class)
        ->prefix('contacts')
        ->as('contacts.')
        ->group(function () {
            Route::get('/',  'index')->name('index');
            Route::delete('delete/{contact}',  'delete')->name('destroy');
        });

    Route::get('history', [HistoryController::class, 'index'])->name('history.index');

    Route::get('change-language/{locale}', [LanguageController::class, 'index'])->name('change.language');
});
