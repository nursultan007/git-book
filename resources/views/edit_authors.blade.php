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
                        <h2>Редактировать автора</h2>

                        <form method="post" action="{{ action('BooksController@updateAuthor') }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="author_id" value="{!! $authors->author_id !!}">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Имя автора" value="{!! $authors->author_name  !!}" required>
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
