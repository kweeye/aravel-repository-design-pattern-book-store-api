<?php

namespace App\Repositories\Backend\Banner;

interface BannerInterface
{
    public function bannerList(array $data);

    public function bannerFields(array $data);

    public function bannerStore(array $data);

    public function bannerUpdate(array $data);

    public function bannerDelete(array $data);

}