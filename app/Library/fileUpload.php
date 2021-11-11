<?php
namespace App\Library;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class fileUpload
{

    public static function uploadAudio($file,$path,$img)
    {
        @list($type, $file_data) = explode(';', $file);
        @list(, $file_data) = explode(',', $file_data);
        $imgPath = $path."/".$img;
        Storage::put('public/'.$imgPath, base64_decode($file_data));
        return("/storage".$imgPath);
    }

    public static function upload($file,$path)
    {
        $pos  = strpos($file, ';');
        $type = explode(':', substr($file, 0, $pos))[1];
        switch ($type) {
            case "image/jpeg":
                $base64 = "data:".$type.";base64,";
                $fileType = "jpeg";
                break;
            case "image/jpg":
                $base64 = "data:".$type.";base64,";
                $fileType = "jpg";
                break;
            case "image/png":
                $base64 = "data:".$type.";base64,";
                $fileType = "png";
                break;
            case "application/pdf":
                $base64 = "data:".$type.";base64,";
                $fileType = "pdf";
                break;
            case "application/xlsx":
                $base64 = "data:".$type.";base64,";
                $fileType = "xlsx";
                break;
            case "application/docx":
                $base64 = "data:".$type.";base64,";
                $fileType = "docx";
                break;
            case "audio/mpeg":
                $base64 = "data:".$type.";base64,";
                $fileType = "mpeg";
                break;
            default:
                $base64 = null;
        }
        $pdfBase64 = str_replace($base64, '', $file);
        $name = rand(1,99).time(). '.' . $fileType;
        $imgPath = $path."/".$name;
        Storage::put('public/'.$imgPath, base64_decode($pdfBase64));
        return("/storage".$imgPath);
    }

    public static function deleteFile($path)
    {
        $file_path = substr($path,1);
        File::delete($file_path);
    }

}