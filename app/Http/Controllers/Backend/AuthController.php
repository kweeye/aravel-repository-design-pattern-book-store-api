<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $model;

    public function __construct(AuthRepository $repository)
    {
        $this->model = $repository;
    }

    public function adminLogin(Request $request)
    {
        return $this->model->adminLogin($request->only('email', 'password'));
    }

}
