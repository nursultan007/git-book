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

                        <form method="post" action="{{ action('BooksController@addBook') }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="author_id" value="{!! $author_id !!}">
                            <div class="form-group">
                                <input type="text" name="book_name" class="form-control" placeholder="Название книги" id="book" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Сохранить">
                            </div>
                        </form>

                        <h4>Автор книг {!! $author_name !!}</h4>

                        @foreach($books_arr as $key=>$value)
                            <ul>
                                <li>{!! $value['book']->book_name !!} -
                                    (соавторы:
                                    <ul style="display: inline; padding: 0;">
                                        @foreach($value['auth'] as $auth)
                                           <li style="display: inline"> {!! $auth->author_name !!}</li>,
                                        @endforeach
                                    </ul>
                                    )
                                    <a href="/add_new_author/{!! $value['book']->book_id !!}/{!! $author_id !!}">Добавить соавтора</a>
                                    <a href="/delete_author_book/{!! $value['book']->book_id !!}/{!! $author_id !!}">Удалить соавтора</a>
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_{!! $value['book']->book_id !!}">Удалить книгу</button>
                                </li>

                                <div class="modal fade" id="myModal_{!! $value['book']->book_id !!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Удаление книги</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Вы действительно хотите удалить книгу <b>{!! $value['book']->book_name !!}</b></p>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-md-2 col-md-offset-8">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                </div>
                                                <div class="col-md-2 col-md-offset-right">
                                                    <form action="{{ action('BooksController@deleteBook') }}" method="POST">
                                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                                        <input type="hidden" name="book_id" value="{!! $value['book']->book_id !!}">
                                                        <input type="hidden" name="author_id" value="{!! $author_id !!}">
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
