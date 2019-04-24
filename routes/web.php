<?php

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
Auth::routes();
Route::middleware('auth')->group(function (){
    Route::name('home')->get('/','HomeController@home');
    Route::prefix('users')->as('users.')->namespace('Auth')->group(
        function (){
            Route::name('index')->get('/{username}','UsersController@index');
            Route::name('edit')->get('/edit/{id}','UsersController@edit');
            Route::name('update')->get('/update/{id}','UsersController@update');
            Route::name('update_photo')->post('/update_photo/{id}','UsersController@update_photo');
            Route::name('update_main_image')->post('/update_main_image/{id}','UsersController@update_main_image');
        }
    );
});

