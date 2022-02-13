<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/v1/categories', [ApiController::class, 'getCategories'])->name('api.categories.index');
Route::get('/v1/posts', [ApiController::class, 'getPosts'])->name('api.posts.index');
Route::get('/v1/tags', [ApiController::class, 'getTags'])->name('api.tags.index');
Route::get('/v1/admins', [ApiController::class, 'getAdmins'])->name('api.admins.index');
Route::get('/v1/roles', [ApiController::class, 'getRoles'])->name('api.roles.index');
