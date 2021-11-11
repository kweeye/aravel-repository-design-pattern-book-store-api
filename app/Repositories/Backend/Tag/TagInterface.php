<?php

namespace App\Repositories\Backend\Tag;

interface TagInterface
{
    public function tagList(array $data);

    public function tagFields(array $data);

    public function tagStore(array $data);

    public function tagUpdate(array $data);

    public function tagDelete(array $data);

}