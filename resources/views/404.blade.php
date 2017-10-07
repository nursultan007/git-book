@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header">
            <ul>
                <li><a href="{{ action('BooksController@index') }}">Главная</a></li>
                <li><a href="{{ action('BooksController@authors') }}">Авторы</a></li>
                <li><a href="{{ action('BooksController@books') }}">Книги</a></li>
            </ul>
        </div>
        <h1 class="text-center">Упс, ошибка!!!</h1>
    </div>
@endsection
