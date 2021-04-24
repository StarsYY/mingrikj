<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//登录，注销
Route::get('/login', 'UserController@Login');
Route::post('/login', 'UserController@DoLogin');
Route::get('/logout', 'UserController@Logout');

//后台
Route::controller('/adm/user', 'UserController');
Route::controller('/adm/news', 'NewsController');
Route::get('/adm', 'UserController@adminIndex');

//前台
Route::controller('/front', 'FrontController');
Route::get('/out/{id}', 'FrontController@Out');
Route::get('/', 'FrontController@Index');
