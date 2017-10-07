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
                        <h2>Добавить новую книгу</h2>

                        <div class="col-md-8">
                            <div class="alert-info">
                                <p>Если автор книги существует, то выберите автора или можете воспользоваться другой формой</p>
                            </div>
                            <table class="table-bordered">
                                <thead>
                                <th class="col-md-1">№</th>
                                <th class="col-md-5">Автор книги</th>
                                </thead>
                                <tbody>
                                @foreach($authors as $key=>$value)
                                    <tr>
                                        <td class="col-md-1">{!! $key+1 !!}</td>
                                        <td  class="col-md-5"><a href="new_book/{!! $value->author_id !!}">{!! $value->author_name !!}</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <form method="post" action="{{ action('BooksController@addAuthorBook') }}">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Автор книги" id="name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="book" class="form-control" placeholder="Название книги" id="book" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Сохранить">
                                </div>
                            </form>
                        </div>

                        <div class="clearfix"></div>
                        <h2>Редактор книг</h2>
                        <ul>
                            @foreach($books as $key=>$value)
                                <li><a href="/edit_book/{!! $value->book_id !!}">{!! $value->book_name !!}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
