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
                        <h2>Добавление соавтора</h2>
                        <form method="post" action="{{ action('BooksController@addBook') }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="book_id" value="{!! $book_id !!}">
                            <input type="hidden" name="main_author" value="{!! $author_id !!}">
                            <div class="form-group">
                                <input type="text" name="book_name" class="form-control" placeholder="Cоавтор книги" id="book" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Сохранить">
                            </div>
                        </form>

                        <h4>Или можете выбрать из списка </h4>

                        <form method="post" action="{{ action('BooksController@addSomeAuthorBook') }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="book_id" value="{!! $book_id !!}">
                            <input type="hidden" name="main_author" value="{!! $author_id !!}">

                            @foreach($authors as $key=>$value)
                                <div class="form-group">
                                    <input type="checkbox" name="option[]" value="{!! $value->author_id !!}"> {!! $value->author_name !!}
                                </div>
                            @endforeach
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Добавить">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
