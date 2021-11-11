<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Author\AuthorRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $model;

    public function __construct(AuthorRepository $repository)
    {
        $this->model = $repository;
    }

    public function authorList(Request $request)
    {
        return $this->model->authorList($request->only('reverse', 'sort', 'name'));
    }

    public function authorFields(Request $request)
    {
        return $this->model->authorFields($request->only('fields'));
    }

    public function authorStore(Request $request)
    {
        return $this->model->authorStore($request->only('name'));
    }

    public function authorUpdate(Request $request)
    {
        return $this->model->authorUpdate($request->only('id', 'name'));
    }

    public function authorDelete(Request $request)
    {
        return $this->model->authorDelete($request->only('id'));
    }


}
