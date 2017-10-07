<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'book_id';

    protected $fillable =  array(
        'book_name'
    );

    public function getBookAuthors() {
        return $this->hasMany('App\AuthorBooks', 'book_id');
    }

    public $timestamps = false;
}
