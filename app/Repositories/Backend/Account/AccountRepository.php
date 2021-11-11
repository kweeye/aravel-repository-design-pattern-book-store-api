<?php

namespace App\Repositories\Backend\Account;

use App\User;
use App\Role;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Tag;
use App\Resources\Backend\AccountCollection;
use App\Library\JsonFormat;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class AccountRepository implements AccountInterface
{
    public function dashboard()
    {
        try {
            $result = [];
            $result['book'] = Book::count('id');
            $result['category'] = Category::count('id');
            $result['author'] = Author::count('id');
            $result['tag'] = Tag::count('id');

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            return JsonFormat::serverErrorJson($success);
        }
    }

    public function accountList(array $data)
    {
        try {
            $reverse = $data['reverse'];
            $sort = $data['sort'];
            if($data['name']){
                $name = $data['name'];
            }else{
                $name = '';
            }
            $account = User::with('roles')->where('name', 'LIKE', '%' . $name . '%');
            $account->orderBy($sort, $reverse);
            $result = $account->paginate(10);
            
            return (new AccountCollection($result));
        }catch(Exception $e) {
            return JsonFormat::serverErrorJson($success);
        }
    }

    public function accountFields(array $data)
    {
        try {
            $result = [];
            if($data['fields']['type'] == "store"){
                $result['role'] = Role::all();
            }
            if($data['fields']['type'] == "update"){
                $result['role'] = Role::all();
                $account = User::with('roles')->where('id', $data['fields']['id'])->first();
                $account['role'] = $account->roles[0]->id;
                $result['account'] = $account;
            }

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function accountStore(array $data)
    {
        try {
            $roleuser = Role::where('id',$data['roleId'])->first();
            $user = new User;
            $user['name'] = $data['name'];
            $user['email'] = $data['email'];
            $user['password'] = Hash::make($data['password']);
            $user->save();
            $user->roles()->attach($roleuser->id);

            return JsonFormat::successJson($user);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function accountUpdate(array $data)
    {
        try {
            $roleuser = Role::where('id',$data['roleId'])->first();
            $user = User::where('id', $data['id'])->firstOrFail();
            $user['name'] = $data['name'];
            $user['email'] = $data['email'];
            if($data['password']){
                $user['password'] = Hash::make($data['password']);
            }
            $user->save();
            $user->roles()->sync($roleuser->id);

            return JsonFormat::successJson($user);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

}