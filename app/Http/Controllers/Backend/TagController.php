<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Tag\TagRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $model;

    public function __construct(TagRepository $repository)
    {
        $this->model = $repository;
    }

    public function tagList(Request $request)
    {
        return $this->model->tagList($request->only('reverse', 'sort', 'name'));
    }

    public function tagFields(Request $request)
    {
        return $this->model->tagFields($request->only('fields'));
    }

    public function tagStore(Request $request)
    {
        return $this->model->tagStore($request->only('name'));
    }

    public function tagUpdate(Request $request)
    {
        return $this->model->tagUpdate($request->only('id', 'name'));
    }

    public function tagDelete(Request $request)
    {
        return $this->model->tagDelete($request->only('id'));
    }


}
