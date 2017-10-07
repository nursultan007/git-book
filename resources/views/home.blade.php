@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Тестовая задания</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="header">
                        <ul>
                            <li><a href="{{ action('BooksController@index') }}">Главная</a></li>
                            <li><a href="{{ action('BooksController@authors') }}">Авторы</a></li>
                            <li><a href="{{ action('BooksController@books') }}">Книги</a></li>
                        </ul>
                    </div>

                    <div class="sorter col-md-4">
                        <form method="get" action="{{ action('BooksController@index') }}" role="search">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <label for="count_books">Количество написанных книг автором</label>
                                <select id="count_books" name="counter_books" class="form-control">
                                    <option value="0">не выбрано</option>
                                    <option value="1" <?php if(isset($_GET['counter_books']) && $_GET['counter_books'] == '1'){ echo 'selected'; } ?>>1 книгa</option>
                                    <option value="2" <?php if(isset($_GET['counter_books']) && $_GET['counter_books'] == '2'){ echo 'selected'; } ?>>2 книги</option>
                                    <option value="3" <?php if(isset($_GET['counter_books']) && $_GET['counter_books'] == '3'){ echo 'selected'; } ?>>3 книги</option>
                                    <option value="more" <?php if(isset($_GET['counter_books']) && $_GET['counter_books'] == 'more'){ echo 'selected'; } ?>>более 3 книг</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="book_name" class="form-control" value="<?php if(isset($_GET['book_name'])){ echo $_GET['book_name']; } ?>" placeholder="Наименование книги">
                            </div>
                            <div class="form-group">
                                <input type="text" name="author_name" class="form-control" value="<?php if(isset($_GET['book_name'])){ echo $_GET['author_name']; } ?>" placeholder="Автор книги">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Найти</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <table class="table-bordered">
                            <thead>
                            <th class="col-md-1">№</th>
                            <th class="col-md-4">Авторы</th>
                            <th class="col-md-7">Название книг</th>
                            </thead>
                            <tbody>
                            @foreach($authors as $key=>$value)
                                <tr>
                                    <td class="col-md-1">{!! $key+1 !!}</td>
                                    <td class="col-md-4">{!! $value->author_name !!}</td>
                                    <td class="col-md-7">
                                        @foreach($value->getAuthorBooks as $key2=>$value2)
                                            <li>{!! $value2->getOnlyBooks->book_name !!}</li>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
