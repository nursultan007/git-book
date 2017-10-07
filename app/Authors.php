<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = 'authors';
    protected $primaryKey = 'author_id';

    protected $fillable =  array(
        'author_name'
    );

    public function getAuthorBooks() {
        return $this->hasMany('App\AuthorBooks', 'author_id');
    }
    public $timestamps = false;
}
