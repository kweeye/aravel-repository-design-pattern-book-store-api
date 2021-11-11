<?php

namespace App\Repositories\Backend\Author;

interface AuthorInterface
{
    public function authorList(array $data);

    public function authorFields(array $data);

    public function authorStore(array $data);

    public function authorUpdate(array $data);

    public function authorDelete(array $data);

}