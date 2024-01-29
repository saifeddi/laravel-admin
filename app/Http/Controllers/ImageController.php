<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use Storage;

class ImageController extends Controller
{
    function upload(ImageRequest $request){
         
         $file = $request->file('image');
         $name = str()->random(10);
        $url  = Storage::putFileAs('images',$file , $name.'.'.$file->extension());
        return response()->json(["url"=>'http://localhost:8000/'.$url]);
     }
}
