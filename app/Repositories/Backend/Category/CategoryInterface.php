<?php

namespace App\Repositories\Backend\Category;

interface CategoryInterface
{
    public function categoryList(array $data);

    public function categoryFields(array $data);

    public function categoryStore(array $data);

    public function categoryUpdate(array $data);

    public function categoryDelete(array $data);

}