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

                        <h4>Соавторы книг </h4>

                        @foreach($authors as $key=>$value)
                            <ul>
                                <li>{!! $value->author_name !!} -
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_{!! $value->author_id !!}">Удалить</button>
                                </li>

                                <div class="modal fade" id="myModal_{!! $value->author_id !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Удаление соавтора</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Вы действительно хотите удалить соавтора <b>{!! $value->author_name !!}</b></p>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-2 col-md-offset-8">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                </div>
                                                <div class="col-md-2 col-md-offset-right">
                                                    <form action="{{ action('BooksController@deleteSomeAuthors') }}" method="POST">
                                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                                        <input type="hidden" name="main_id_auth" value="{!! $author_id !!}">
                                                        <input type="hidden" name="book_id" value="{!! $book_id !!}">
                                                        <input type="hidden" name="author_id" value="{!! $value->author_id !!}">
                                                        <input type="submit" class="btn btn-primary" value="Удалить">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
