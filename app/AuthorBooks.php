<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorBooks extends Model
{
    protected $table = 'authors_to_books';

    protected $primaryKey = 'ab_id';

    protected $fillable  = array(
        'author_id',
        'book_id '
    );

    public function getOnlyBooks() {
        return $this->belongsTo('\App\Books', 'book_id');
    }

    public function getOnlyAuthors() {
        return $this->belongsTo('\App\Authors', 'author_id');
    }

    public $timestamps = false;
}
