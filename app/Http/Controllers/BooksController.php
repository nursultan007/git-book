<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Authors;
use App\Books;
use App\AuthorBooks;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->_token)){
            $books = AuthorBooks::select('ab_id', 'book_name', 'author_name')
                ->join('books', 'books.book_id', '=', 'authors_to_books.book_id')
                ->join('authors', 'authors.author_id', '=', 'authors_to_books.author_id')
                ->where('books.book_name', 'like', '%' . $request->book_name . '%')
                ->where('authors.author_name', 'like', '%' . $request->author_name . '%')
                ->get();

            $authors_arr = array();
            foreach($books as $key=>$value){
                $authors = $value->author_name;
                array_push($authors_arr, $authors);
            }
            $authors_arr = array_unique($authors_arr);

            $results = array();

            if($request->counter_books == '0'){
                foreach($authors_arr as $key=>$value){
                    $author_book = Authors::where('author_name','=',$value)->first();
                    array_push($results, $author_book);
                }
            }
            else if($request->counter_books == 'more'){
                foreach($authors_arr as $key=>$value){
                    $author_book = Authors::where('author_name','=',$value)->first();
                    $author = AuthorBooks::where('author_id','=',$author_book->author_id)->get();
                    if(count($author) > 3){
                        array_push($results, $author_book);
                    }
                }
            }
            else{
                foreach($authors_arr as $key=>$value){
                    $author_book = Authors::where('author_name','=',$value)->first();
                    $author = AuthorBooks::where('author_id','=',$author_book->author_id)->get();
                    if(count($author) == $request->counter_books){
                        array_push($results, $author_book);
                    }
                }
            }
            $authors = $results;
        }
        else{
            $authors = Authors::all();
        }

        return view('home', compact('authors'));
    }

    public function authors()
    {
        $authors = Authors::all();
        return view('authors', compact('authors'));
    }

    public function editAuthors(Request $request)
    {
        $authors = Authors::find($request->author_id);
        return view('edit_authors', compact('authors'));
    }

    public function updateAuthor(Request $request)
    {
        $author = Authors::find($request->author_id);
        $author->author_name = $request->name;
        $author->save();
        return redirect()->action('BooksController@authors');
    }

    public function deleteAuthor(Request $request, Books $books, Authors $authors, AuthorBooks $authorBooks)
    {
        $a_books = AuthorBooks::where('author_id', '=', $request->author_id)->get();

        foreach($a_books as $val){
            $authorBooks = $authorBooks->find($val->ab_id);
            $authorBooks->delete();
            $s_book = AuthorBooks::where('book_id','=',$val->book_id)->get();
            if(empty($s_book)){
                $books = $books->find($val->book_id);
                $books->delete();
            }
        }

        $authors = $authors->find($request->author_id);
        $authors->delete();

        return redirect()->action(
            'BooksController@authors'
        );
    }


    public function books()
    {
        $authors = Authors::all()->sortBy('author_name');
        $books = Books::all();
        return view('books', compact('authors', 'books'));
    }

    public function editBookPage(Request $request)
    {
        $book = Books::find($request->book_id);
        return view('edit_book', compact('book'));
    }

    public function updateBookName(Request $request)
    {
        $book = Books::find($request->book_id);
        $book->book_name = $request->book;
        $book->save();
        return redirect()->action('BooksController@books');
    }

    public function addAuthor(Request $request, Authors $authors){
        $authors->author_name = $request->name;
        $authors->save();
        return redirect()->action('BooksController@authors');
    }

    public function newBookPage(Request $request, Books $books){
        $author_id = $request->author_id;
        $author = Authors::where('author_id','=', $author_id)->first();
        $author_name = $author['author_name'];

        if(empty($author)){
            return redirect()->action('BooksController@error');
        }
        else{
            $books_ab = AuthorBooks::where('author_id', '=', $author_id)->get();
            $books_arr = array();
            foreach($books_ab as $key=>$value){
                $new_book = Books::where('book_id','=',$value['book_id'])->first();
                $soavtor = AuthorBooks::where('author_id', '!=', $value['author_id'])->where('book_id', '=', $value['book_id'])->get();
                $some_arr = array();
                foreach($soavtor as $j){
                    $new_auth = Authors::where('author_id', '=', $j['author_id'])->first();
                    array_push($some_arr, $new_auth);
                }
                $my_arr = array('book'=>$new_book,'auth'=>$some_arr);
                array_push($books_arr, $my_arr);
            }
            return view('new_book', compact('author_id', 'author_name', 'books_arr'));
        }
    }

    public function addBook(Request $request, Books $books, AuthorBooks $authorBooks){
        $books->book_name = $request->book_name;
        $books->save();

        $last_book = Books::where('book_name','=', $request->book_name)->first();
        $authorBooks->author_id = $request->author_id;
        $authorBooks->book_id = $last_book['book_id'];
        $authorBooks->save();

        return redirect()->action(
            'BooksController@newBookPage', ['author_id' => $request->author_id]
        );
    }

    public function deleteBook(Request $request, Books $books, AuthorBooks $authorBooks){
        $auth_book = AuthorBooks::where('book_id','=', $request->book_id)->get();
        foreach($auth_book as $val){
            $authorBooks = $authorBooks->find($val->ab_id);
            $authorBooks->delete();
        }

        $books = $books->find($request->book_id);
        $books->delete();

        return redirect()->action(
            'BooksController@newBookPage', ['author_id' => $request->author_id]
        );
    }

    public function addAuthorBook(Request $request, Authors $authors, Books $books, AuthorBooks $authorBooks){
        $authors->author_name = $request->name;
        $authors->save();
        $last_author = Authors::where('author_name', '=', $request->name)->first();

        $books->book_name = $request->book;
        $books->save();
        $last_book = Books::where('book_name','=', $request->book)->first();

        $authorBooks->book_id = $last_book['book_id'];
        $authorBooks->author_id = $last_author['author_id'];
        $authorBooks->save();

        return redirect()->action('BooksController@books');
    }

    public function newAuthorBook(Request $request){
        $book_id = $request->book_id;
        $author_id = $request->author_id;
        $books_ab = AuthorBooks::where('book_id', '=', $book_id)->get();
        $authors = Authors::where('author_id', '!=', $author_id)->get();

        foreach($books_ab as $j){
            foreach($authors as $i=>$k){
                if($k['author_id'] == $j['author_id']){
                    unset($authors[$i]);
                }
            }
        }

        return view('new_author', compact('book_id', 'author_id', 'authors'));
    }

    public function addSomeAuthorBook(Request $request, AuthorBooks $authorBooks){
        foreach($request->option as $value){
            $authorBooks->book_id = $request->book_id;
            $authorBooks->author_id = $value;
            $authorBooks->save();
        }
        return redirect()->action(
            'BooksController@newBookPage', ['author_id' => $request->main_author]
        );
    }

    public function deleteAuthorBook(Request $request){
        $book_id = $request->book_id;
        $author_id = $request->author_id;

        $auth_book = AuthorBooks::where('book_id','=', $book_id)->where('author_id','!=',$author_id)->get();
        $authors = array();
        foreach($auth_book as $k=>$val){
            $new_auth = Authors::where('author_id', '=', $val['author_id'])->first();
            array_push($authors, $new_auth);
        }
        return view('some_authors', compact('book_id', 'author_id', 'authors'));
    }

    public function deleteSomeAuthors(Request $request){
        $auth_book = AuthorBooks::where('book_id','=', $request->book_id)->where('author_id','=',$request->author_id)->first();
        $auth_book->delete();

        return redirect()->action(
            'BooksController@newBookPage', ['author_id' => $request->main_id_auth]
        );
    }

    public function error()
    {
        return view('404');
    }
}