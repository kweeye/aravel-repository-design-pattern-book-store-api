<?php

namespace App\Repositories\Backend\Auth;

use App\User;
use App\Role;
use App\Library\JsonFormat;
use Auth;
use Illuminate\Database\Eloquent\Model;

class AuthRepository implements AuthInterface
{
    public function __construct()
    {

    }

    public function adminLogin(array $data)
    {
        try {
            $email = $data['email'];
            $password = $data['password'];
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = User::with('roles')->where('id', Auth::user()->id)->first();
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['name'] = $user->name;
                $success['email'] = $user->email;
                $success['phone'] = $user->phone;
                $success['role'] = $user->roles[0]->slug;
                return JsonFormat::successJson($success);
            }else{
                $success = [];
                return JsonFormat::errorJson($success);
            }
        }catch(Exception $e) {
            return response()->json(['status' => 'fail', 'message' => "Connection Error", 'data' => ""], 500);
        }
    }

}