<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable = ['name','slug','permissions'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function hasAccess(array $permissions)
    {
        foreach($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
        }
        return false;
    }

    protected function hasPermission(string $permission)
    {
        $checkPermission = json_decode($this->permissions,true);
        if(array_key_exists($permission,$checkPermission)){
            return true;
        }
        else{
            abort(404);
        }

    }
}
