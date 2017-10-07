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
                        <h1>Добавить нового автора книги</h1>
                        <form method="post" action="{{ action('BooksController@addAuthor') }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Введите имя автора книги" id="name" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Сохранить">
                            </div>
                        </form>

                        <table class="table-bordered">
                            <thead>
                            <th class="col-md-1">№</th>
                            <th class="col-md-5">Имя</th>
                            <th class="col-md-3">Редактировать данные</th>
                            <th class="col-md-3">Удалить данные</th>
                            </thead>
                            <tbody>

                            @foreach($authors as $key=>$value)
                                    <tr>
                                        <td class="col-md-1">{!! $key+1 !!}</td>
                                        <td  class="col-md-5">{!! $value->author_name !!}</td>
                                        <td class="col-md-3"><a href="/edit_authors/{!! $value->author_id !!}">Изменить</a></td>
                                        <td class="col-md-3"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_{!! $value->author_id !!}">Удалить</button></td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @foreach($authors as $key=>$value)
                            <div class="modal fade" id="myModal_{!! $value->author_id !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Удаление автора</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Вы действительно хотите удалить автора <b>{!! $value->author_name !!}</b> и его работы?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-md-2 col-md-offset-8">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                            </div>
                                            <div class="col-md-2 col-md-offset-right">
                                                <form action="{{ action('BooksController@deleteAuthor') }}" method="POST">
                                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                                    <input type="hidden" name="author_id" value="{!! $value->author_id !!}">
                                                    <input type="submit" class="btn btn-primary" value="Удалить">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
