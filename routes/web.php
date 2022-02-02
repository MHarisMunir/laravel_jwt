<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/a', function(){
    return Auth::user()->name;
});



Route::get('/register', 'App\Http\Controllers\RegisterController@index')->name('register');
Route::post('/user/register', 'App\Http\Controllers\AuthController@register')->name('user.register');

Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');
Route::post('/user/login', 'App\Http\Controllers\AuthController@login')->name('user.login');



Route::middleware(['auth'])->group(function(){
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

});
