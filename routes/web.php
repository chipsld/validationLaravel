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

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/','TopicController@index')->name('home');
Route::resource('topics','TopicController',['except'=>['index']]);

Route::post('commentaire','TopicController@comment')->name('commentaire');
Route::get('recherche','TopicController@search')->name('recherche');


Auth::routes();


Route::get('/migrate', function(){
    // Artisan::call('migrate');
    Artisan::call('db:seed');
});