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
    return view('welcome');
});

Route::get('404', 'BooksController@error');

Auth::routes();

Route::group(array('middleware' => 'auth'), function(){
    Route::get('/home', ['as' => 'search', 'uses' => 'BooksController@index']);
    Route::get('/authors', 'BooksController@authors');
    Route::get('/edit_authors/{author_id}', 'BooksController@editAuthors');
    Route::get('/books', 'BooksController@books');
    Route::get('/new_book/{author_id}', 'BooksController@newBookPage');
    Route::get('/edit_book/{book_id}', 'BooksController@editBookPage');
    Route::get('/add_new_author/{book_id}/{author_id}', 'BooksController@newAuthorBook');
    Route::get('/delete_author_book/{book_id}/{author_id}', 'BooksController@deleteAuthorBook');

    Route::post('/add_author', 'BooksController@addAuthor');
    Route::post('/delete_author', 'BooksController@deleteAuthor');
    Route::post('/add_book', 'BooksController@addBook');
    Route::post('/delete_book', 'BooksController@deleteBook');
    Route::post('/update_book', 'BooksController@updateBookName');
    Route::post('/update_author', 'BooksController@updateAuthor');
    Route::post('/add_ab', 'BooksController@addAuthorBook');
    Route::post('/add_some_authors', 'BooksController@addSomeAuthorBook');
    Route::post('/delete_some_authors', 'BooksController@deleteSomeAuthors');
});