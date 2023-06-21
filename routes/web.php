<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', function () {
        if (!Auth::check()) {    	        	
            return Redirect::to('admin/login');
        } else {
            return Redirect::to('admin/dashboard');
        }
    });

    Route::get('login', 'AuthController@loginView')->name('login');
    Route::get('register', 'AuthController@registerView');
    Route::post('login', 'AuthController@doLogin');
        Route::get('logout', 'AuthController@doLogout');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard', 'AuthController@dashboard');

        Route::resource('users', 'UserController');
        Route::get('users/{id}/destroy', 'UserController@destroy');
        Route::get('users/{id}/status', 'UserController@statusChange');
    });
});
