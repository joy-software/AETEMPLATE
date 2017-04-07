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

Route::get('/', function () {
    return view('auth/login');
});


Route::get('/home', 'HomeController@auth');

Route::get('/test', [
    'as' => 'test',
    'uses' => 'HomeController@index'
]);

Route::get('/annuaire', [
    'as' => 'annuaire',
    'uses' => 'AnnuaireController@index'
]);

Auth::routes();
