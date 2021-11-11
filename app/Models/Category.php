<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'category';

    public function book()
    {
        return $this->hasMany('App\Models\Book','category_id','id');
    }

}
