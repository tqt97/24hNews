<?php

use App\Http\Controllers\SliderController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\web\CommentController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\web\SearchController;
use App\Http\Controllers\Web\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('web.home');
// });
// Route::get('/about-us', function () {
//     return view('web.about-us');
// });
// Route::get('/category', function () {
//     return view('web.category');
// });
// Route::get('/detail', function () {
//     return view('web.detail');
// });
// Route::get('/contact', function () {
//     return view('web.contact');
// });
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::get('/', HomeController::class)->name('home');
Route::get('/about-us', AboutController::class)->name('about');
// Route::get('search', [HomeController::class, 'index'])->name('search');
// Route::get('/', [AboutController::class, 'index'])->name('home');
// Route::get('/', [PostController::class, 'index'])->name('home');
// Route::get('/', [CategoryController::class, 'index'])->name('home');

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{slug}', [PostController::class, 'show'])->name('posts.show');
});
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{slug}', [CategoryController::class, 'show'])->name('categories.show');
});
Route::prefix('tags')->group(function () {
    Route::get('/{slug}', [TagController::class, 'show'])->name('tags.show');
});
Route::prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('search');
});
Route::prefix('contact')->group(function () {
    Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
});

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('comments')->group(function () {
        Route::post('/store', [CommentController::class, 'store'])->name('comments.store');
    });
});
