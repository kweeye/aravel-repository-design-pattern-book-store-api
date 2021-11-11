<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use SoftDeletes;

    protected $table = 'author';

    public function book()
    {
        return $this->hasMany('App\Models\Book','author_id','id');
    }

}
