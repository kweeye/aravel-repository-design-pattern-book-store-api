<?php

namespace App\Repositories\Backend\Category;

use App\Models\Category;
use App\Resources\Backend\CategoryCollection;
use App\Library\JsonFormat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryInterface
{
    public function __construct()
    {

    }

    public function categoryList(array $data)
    {
        try {
            $reverse = $data['reverse'];
            $sort = $data['sort'];
            if($data['name']){
                $name = $data['name'];
            }else{
                $name = '';
            }
            $category = Category::where('name', 'LIKE', '%' . $name . '%');
            $category->orderBy($sort, $reverse);
            $result = $category->paginate(10);
            
            return (new CategoryCollection($result));
        }catch(Exception $e) {
            return JsonFormat::serverErrorJson($success);
        }
    }

    public function categoryFields(array $data)
    {
        try {
            $result = category::where('id', $data['fields']['id'])->first();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function categoryStore(array $data)
    {
        try {
            $category = new Category;
            $category['name'] = $data['name'];
            $result = $category->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function categoryUpdate(array $data)
    {
        try {
            $category = Category::where('id', $data['id'])->firstOrFail();
            $category['name'] = $data['name'];
            $result = $category->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function categoryDelete(array $data)
    {
        try {
            $category = Category::with('book')->findorfail($data['id']);
            if(count($category->book) > 0){
                return response()->json(['status' => 'success', 'message' => "This category used on book!", 'data' => $data], 200);
            }
            $category->delete();

            return JsonFormat::successJson();
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

}