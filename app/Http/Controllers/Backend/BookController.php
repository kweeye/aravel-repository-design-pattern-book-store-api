<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Book\BookRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $model;

    public function __construct(BookRepository $repository)
    {
        $this->model = $repository;
    }

    public function bookList(Request $request)
    {
        return $this->model->bookList($request->only('reverse', 'sort', 'name'));
    }

    public function bookFields(Request $request)
    {
        return $this->model->bookFields($request->only('fields'));
    }

    public function bookStore(Request $request)
    {
        return $this->model->bookStore($request->only('name', 'categoryId', 'authorId', 'tagId', 'shortDescription', 'image'));
    }

    public function bookUpdate(Request $request)
    {
        return $this->model->bookUpdate($request->only('id', 'name', 'categoryId', 'authorId', 'tagId', 'shortDescription', 'image'));
    }

    public function bookDelete(Request $request)
    {
        return $this->model->bookDelete($request->only('id'));
    }


}
