<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Backend\Account\AccountRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $model;

    public function __construct(AccountRepository $repository)
    {
        $this->model = $repository;
    }

    public function dashboard(Request $request)
    {
        return $this->model->dashboard();
    }

    public function accountList(Request $request)
    {
        return $this->model->accountList($request->only('reverse', 'sort', 'name'));
    }

    public function accountFields(Request $request)
    {
        return $this->model->accountFields($request->only('fields'));
    }

    public function accountStore(Request $request)
    {
        return $this->model->accountStore($request->only('roleId', 'name', 'email', 'password'));
    }

    public function accountUpdate(Request $request)
    {
        return $this->model->accountUpdate($request->only('id', 'roleId',  'name', 'email', 'password'));
    }

}
