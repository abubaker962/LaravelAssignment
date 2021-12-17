<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'BookController@index')->name('all-books');

Route::get('/newBookForm', 'BookController@showAddBookForm')->name('new-book-form');

Route::post('/addBook', 'BookController@addBook')->name('add-book');

Route::get('/editBook/{id}', 'BookController@editBook');

Route::post('/updateBook/{id}', 'BookController@updateBook');

Route::delete('/deleteBook/{id}', 'BookController@deleteBook');

Route::get('/search', 'BookController@search')->name('search');