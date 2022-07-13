<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;

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
// User Route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Blog Route



Route::middleware('auth:sanctum')->group(function () {
    // protected route for getting the authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // protected route for logging out a user
    Route::post('/logout', [AuthController::class, 'logout']);

    // protected route for creating a new post
    Route::post('/posts', [BlogController::class, 'store']);

    // protected route for getting all posts
    Route::get('/posts', [BlogController::class, 'index']);

    // protected route for getting a single post
    Route::get('/posts/{id}', [BlogController::class, 'show']);

    // protected route for updating a post
    Route::put('/posts/{id}', [BlogController::class, 'update']);

    // protected route for deleting a post
    Route::delete('/posts/{id}', [BlogController::class, 'destroy']);
});