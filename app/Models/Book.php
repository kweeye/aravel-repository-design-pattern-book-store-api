<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'book';

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Author','author_id','id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag','tag_id','id');
    }

}
