<?php

namespace App\Actions\Admin;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UpdateProductImagesAction
{
    public function execute(array $files, Product $product): void
    {
        $productImages = collect();
//        dump('imagenes del producto antes', $product->images);
        foreach ($product->images as $image){
//            dump($product->id,$image->file_name);
            Storage::disk(config('filesystems.images_disk'))->delete($product->id.'/'.$image->file_name);
            $image->delete();
        }

//        dump('imagenes del producto despues', $product->images());
        foreach ($files as $file) {
//            dump("file",$file);
//            dump("extension",$file->getClientOriginalExtension());
//            dump("mime 1",$file->getMimeType());
//            dump("extension2",$file->extension());
//            dump("extension3    ",$file->clientExtension());

//
            $image = new Image();
//            $mimetype = Storage::mimeType($filename);
            $image->file_name = (string) Str::uuid() . '.' . $file->clientExtension();

            $file->storeAs($product->id, $image->file_name , config('filesystems.images_disk'));
            //path , name , disk
            $productImages->push($image);
//            dump($image);
        }
//
        $product->images()->saveMany($productImages);
        $product->refresh();
//        dump('imagenes del producto Al final', $product->images);
    }
}
