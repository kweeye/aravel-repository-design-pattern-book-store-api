<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Category\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $model;

    public function __construct(CategoryRepository $repository)
    {
        $this->model = $repository;
    }

    public function categoryList(Request $request)
    {
        return $this->model->categoryList($request->only('reverse', 'sort', 'name'));
    }

    public function categoryFields(Request $request)
    {
        return $this->model->categoryFields($request->only('fields'));
    }

    public function categoryStore(Request $request)
    {
        return $this->model->categoryStore($request->only('name'));
    }

    public function categoryUpdate(Request $request)
    {
        return $this->model->categoryUpdate($request->only('id', 'name'));
    }

    public function categoryDelete(Request $request)
    {
        return $this->model->categoryDelete($request->only('id'));
    }


}
