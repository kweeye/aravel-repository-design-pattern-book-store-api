<?php

namespace App\Repositories\Backend\Banner;

use App\Models\Banner;
use App\Resources\Backend\BannerCollection;
use App\Library\fileUpload;
use App\Library\JsonFormat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class BannerRepository implements BannerInterface
{
    public function __construct()
    {

    }

    public function bannerList(array $data)
    {
        try {
            $reverse = $data['reverse'];
            $sort = $data['sort'];
            if($data['title']){
                $title = $data['title'];
            }else{
                $title = '';
            }
            $banner = Banner::where('title', 'LIKE', '%' . $title . '%');
            $banner->orderBy($sort, $reverse);
            $result = $banner->paginate(10);
            
            return (new BannerCollection($result));
        }catch(Exception $e) {
            return JsonFormat::serverErrorJson($success);
        }
    }

    public function bannerFields(array $data)
    {
        try {
            $result = Banner::where('id', $data['fields']['id'])->first();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function bannerStore(array $data)
    {
        try {
            $file = $data['image'];
            if($file){
                $path = '/banner';
                $image = fileUpload::upload($file,$path);
            }else{
                $image = '';
            }
            $banner = new banner;
            $banner['title'] = $data['title'];
            $banner['short_description'] = $data['shortDescription'];
            $banner['link'] = $data['link'];
            $banner['image'] = $image;
            $result = $banner->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function bannerUpdate(array $data)
    {
        try {
            $banner = Banner::where('id', $data['id'])->firstOrFail();
            $file = $data['image'];
            if($file){
                fileUpload::deleteFile($banner->image);
                $path = '/banner';
                $image = fileUpload::upload($file,$path);
                $banner['image'] = $image;
            }
            $banner['title'] = $data['title'];
            $banner['short_description'] = $data['shortDescription'];
            $banner['link'] = $data['link'];
            $result = $banner->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function bannerDelete(array $data)
    {
        try {
            $banner = Banner::findorfail($data['id']);
            $banner->delete();

            return JsonFormat::successJson();
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

}