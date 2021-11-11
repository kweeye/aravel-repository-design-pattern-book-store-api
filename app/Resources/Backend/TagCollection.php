<?php

namespace App\Resources\Backend;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Library\JsonFormat;

class TagCollection extends ResourceCollection
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
                    'name' => $page->name
                ];
            }),
        ];
    }

    public function with($request)
    {
        return JsonFormat::paginateJson();
    }
}
