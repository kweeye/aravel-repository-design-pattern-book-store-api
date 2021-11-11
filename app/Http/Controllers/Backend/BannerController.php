<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Banner\BannerRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $model;

    public function __construct(BannerRepository $repository)
    {
        $this->model = $repository;
    }

    public function bannerList(Request $request)
    {
        return $this->model->bannerList($request->only('reverse', 'sort', 'title'));
    }

    public function bannerFields(Request $request)
    {
        return $this->model->bannerFields($request->only('fields'));
    }

    public function bannerStore(Request $request)
    {
        return $this->model->bannerStore($request->only('title', 'shortDescription', 'link', 'image'));
    }

    public function bannerUpdate(Request $request)
    {
        return $this->model->bannerUpdate($request->only('id', 'title', 'shortDescription', 'link', 'image'));
    }

    public function bannerDelete(Request $request)
    {
        return $this->model->bannerDelete($request->only('id'));
    }


}
