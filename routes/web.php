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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'QuestionController@index')->name('home');

Route::get('/question', 'QuestionController@create')->name('createquestion');

Route::get('/view/question/{id}', 'QuestionController@view')->name('viewquestion');

Route::get('/edit/question/{id}', 'QuestionController@edit')->name('editquestion');

Route::get('/delete/question/{id}', 'QuestionController@delete')->name('deletequestion');

Route::post('/question/post', 'QuestionController@post')->name('postquestion');

Route::post('/question/update', 'QuestionController@update')->name('updatequestion');

Route::post('/search', 'QuestionController@search')->name('search');