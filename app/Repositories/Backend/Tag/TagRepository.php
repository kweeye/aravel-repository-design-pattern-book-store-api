<?php

namespace App\Repositories\Backend\Tag;

use App\Models\Tag;
use App\Resources\Backend\TagCollection;
use App\Library\JsonFormat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class TagRepository implements TagInterface
{
    public function __construct()
    {

    }

    public function tagList(array $data)
    {
        try {
            $reverse = $data['reverse'];
            $sort = $data['sort'];
            if($data['name']){
                $name = $data['name'];
            }else{
                $name = '';
            }
            $tag = Tag::where('name', 'LIKE', '%' . $name . '%');
            $tag->orderBy($sort, $reverse);
            $result = $tag->paginate(10);
            
            return (new tagCollection($result));
        }catch(Exception $e) {
            return JsonFormat::serverErrorJson($success);
        }
    }

    public function tagFields(array $data)
    {
        try {
            $result = Tag::where('id', $data['fields']['id'])->first();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function tagStore(array $data)
    {
        try {
            $tag = new Tag;
            $tag['name'] = $data['name'];
            $result = $tag->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function tagUpdate(array $data)
    {
        try {
            $tag = Tag::where('id', $data['id'])->firstOrFail();
            $tag['name'] = $data['name'];
            $result = $tag->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function tagDelete(array $data)
    {
        try {
            $tag = Tag::with('book')->findorfail($data['id']);
            if(count($author->book) > 0){
                return response()->json(['status' => 'success', 'message' => "This author used on book!", 'data' => $data], 200);
            }
            $tag->delete();

            return JsonFormat::successJson();
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

}