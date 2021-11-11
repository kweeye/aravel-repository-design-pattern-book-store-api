<?php

namespace App\Resources\Backend;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Library\JsonFormat;

class BookCollection extends ResourceCollection
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
                    'name' => $page->name,
                    'category' => $page->category->name,
                    'author' => $page->author->name,
                    'tag' => $page->tag->name,
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
