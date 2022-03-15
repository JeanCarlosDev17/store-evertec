<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function store(Request $request)
    {
        if($request->hasFile('images')){
            $productImages = $request->file('images');
            foreach ($productImages as $productImage) {
                $filename=$productImage->getClientOriginalName();
                $folder=uniqid().'-'.now()->timestamp;
                $productImage->storeAs('tmp/'.$folder,$filename);
                $productUrl = $folder .'/'. $filename;
                return $productUrl;
            }
        }
        return "";
    }
}
