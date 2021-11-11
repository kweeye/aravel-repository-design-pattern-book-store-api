<?php
namespace App\Library;

class JsonFormat
{

    public function __construct()
    {

    }

    public static function successJson($data = "")
    {
        return response()->json(["data" => $data, "status" => "success", "message" => "", "error" => []], 200);
    }

    public static function errorJson($data = "")
    {
        return response()->json(["data" => $data, "status" => "fail", "message" => "", "error" => []], 200);
    }

    public static function serverErrorJson($data = "" )
    {
        return response()->json(["data" => $data, "status" => "fail", "message" => "Connection Error", "error" => []], 500);
    }

    public static function paginateJson()
    {
        return ["status" => "success", "message" => "", "error" => []];
    }
}