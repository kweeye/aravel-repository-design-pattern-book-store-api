<?php

namespace App\Repositories\Backend\Book;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Tag;
use App\Resources\Backend\BookCollection;
use App\Library\fileUpload;
use App\Library\JsonFormat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class BookRepository implements BookInterface
{
    public function __construct()
    {

    }

    public function bookList(array $data)
    {
        try {
            $reverse = $data['reverse'];
            $sort = $data['sort'];
            if($data['name']){
                $name = $data['name'];
            }else{
                $name = '';
            }
            $book = Book::with('category', 'author', 'tag')->where('name', 'LIKE', '%' . $name . '%');
            $book->orderBy($sort, $reverse);
            $result = $book->paginate(10);
            
            return (new BookCollection($result));
        }catch(Exception $e) {
            return JsonFormat::serverErrorJson($success);
        }
    }

    public function bookFields(array $data)
    {
        try {
            $result = [];
            if($data['fields']['type'] == "store"){
                $result['category'] = Category::all();
                $result['author'] = Author::all();
                $result['tag'] = Tag::all();
            }
            if($data['fields']['type'] == "update"){
                $result['category'] = Category::all();
                $result['author'] = Author::all();
                $result['tag'] = Tag::all();
                $result['book'] = Book::where('id', $data['fields']['id'])->first();
            }

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function bookStore(array $data)
    {
        try {
            $file = $data['image'];
            if($file){
                $path = '/book';
                $image = fileUpload::upload($file,$path);
            }else{
                $image = '';
            }
            $book = new Book;
            $book['category_id'] = $data['categoryId'];
            $book['author_id'] = $data['authorId'];
            $book['tag_id'] = $data['tagId'];
            $book['name'] = $data['name'];
            $book['short_description'] = $data['shortDescription'];
            $book['image'] = $image;
            $result = $book->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function bookUpdate(array $data)
    {
        try {
            $book = Book::where('id', $data['id'])->firstOrFail();
            $file = $data['image'];
            if($file){
                fileUpload::deleteFile($book->image);
                $path = '/book';
                $image = fileUpload::upload($file,$path);
                $book['image'] = $image;
            }
            $book['category_id'] = $data['categoryId'];
            $book['author_id'] = $data['authorId'];
            $book['tag_id'] = $data['tagId'];
            $book['name'] = $data['name'];
            $book['short_description'] = $data['shortDescription'];
            $result = $book->save();

            return JsonFormat::successJson($result);
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

    public function bookDelete(array $data)
    {
        try {
            $book = Book::findorfail($data['id']);
            $book->delete();


            return JsonFormat::successJson();
        }catch(Exception $e) {
            JsonFormat::errorJson();
        }
    }

}