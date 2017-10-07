@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Тестовая задания</div>

                    <div class="panel-body">
                        <div class="header">
                            <ul>
                                <li><a href="{{ action('BooksController@index') }}">Главная</a></li>
                                <li><a href="{{ action('BooksController@authors') }}">Авторы</a></li>
                                <li><a href="{{ action('BooksController@books') }}">Книги</a></li>
                            </ul>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2>Редактировать книгу</h2>

                        <form method="post" action="{{ action('BooksController@updateBookName') }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="book_id" value="{!! $book->book_id !!}">
                            <div class="form-group">
                                <input type="text" name="book" class="form-control" placeholder="Название книги" value="{!! $book->book_name  !!}" id="book" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Сохранить">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
