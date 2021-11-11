<?php

namespace App\Resources\Backend;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Library\JsonFormat;

class BannerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collectResource($this->collection)->transform(function($page){
                return [
                    'id' => $page->id,
                    'title' => $page->title,
                    'image' => $page->image
                ];
            }),
        ];
    }

    public function with($request)
    {
        return JsonFormat::paginateJson();
    }
}
