<?php

namespace App\Repositories\Backend\Book;

interface BookInterface
{
    public function bookList(array $data);

    public function bookFields(array $data);

    public function bookStore(array $data);

    public function bookUpdate(array $data);

    public function bookDelete(array $data);

}