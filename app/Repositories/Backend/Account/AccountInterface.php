<?php

namespace App\Repositories\Backend\Account;

interface AccountInterface
{
    public function dashboard();

    public function accountList(array $data);

    public function accountFields(array $data);

    public function accountStore(array $data);

    public function accountUpdate(array $data);
}