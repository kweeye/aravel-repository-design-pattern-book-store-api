<?php

namespace App\Repositories\Backend\Auth;

interface AuthInterface
{
    public function adminLogin(array $data);
}