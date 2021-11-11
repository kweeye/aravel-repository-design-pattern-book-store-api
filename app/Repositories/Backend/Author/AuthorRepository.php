<?php

namespace App\Repositories\Backend\Author;

use App\Models\Author;
use App\Resources\Backend\AuthorCollection;
use App\Library\JsonFormat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class AuthorRepository implements AuthorInterface
{
    public function __construct()
    {

    }

    public function authorList(array $data)
    {
        try {
            $reverse = $data['reverse'];
            $sort = $data['sort'];
            if($data['name']){
                $name = $data['name'];
            }else{
                $name = '';
            }
            $author = Author::where('name', 'LIKE', '%' . $name . '%');
            $author->orderBy($sort, $reverse);
            $result = $author->paginate(10);
            
            return (new AuthorCollection($result));
        }catch(Exception $e) {
            return JsonFormat::serverErrorJson($success);
        }
    }

    public function authorFields(array $data)
    {
        try {
            $result = Author::where('id', $data['fields']['id'])->first();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function authorStore(array $data)
    {
        try {
            $author = new Author;
            $author['name'] = $data['name'];
            $result = $author->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function authorUpdate(array $data)
    {
        try {
            $author = Author::where('id', $data['id'])->firstOrFail();
            $author['name'] = $data['name'];
            $result = $author->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function authorDelete(array $data)
    {
        try {
            $author = Author::with('book')->findorfail($data['id']);
            if(count($author->book) > 0){
                return response()->json(['status' => 'success', 'message' => "This author used on book!", 'data' => $data], 200);
            }
            $author->delete();

            return JsonFormat::successJson();
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

}