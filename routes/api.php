<?php

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

// Route::group(
//     [
//         'middleware' => 'api',
//         'namespace'  => 'App\Http\Controllers',
//         'prefix'     => 'auth',
//     ],
//     function ($router) {
//         Route::post('login', 'AuthController@login');
//         Route::post('register', 'AuthController@register');
//         Route::post('logout', 'AuthController@logout');
//         Route::get('profile', 'AuthController@profile');
//         Route::post('refresh', 'AuthController@refresh');
//     }
// );

// Route::group(
//     [
//         'middleware' => 'api',
//         'namespace'  => 'App\Http\Controllers',
//     ],
//     function ($router) {
//         Route::resource('todos', 'TodoController');
//     }
// );



// Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
// Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
//     Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
// });


////////////////////////////////////////////

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/user-profile', [\App\Http\Controllers\AuthController::class, 'userProfile']);
});


