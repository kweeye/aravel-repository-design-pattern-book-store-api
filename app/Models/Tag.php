<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tag';

    public function book()
    {
        return $this->hasMany('App\Models\Book','tag_id','id');
    }

}
