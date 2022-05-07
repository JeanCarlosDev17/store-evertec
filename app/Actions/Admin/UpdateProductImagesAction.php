<?php

namespace App\Actions\Admin;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProductImagesAction
{
    public function execute(array $files, Product $product): void
    {
        $productImages = collect();

        foreach ($product->images as $image) {
            Storage::disk(config('filesystems.images_disk'))->delete($product->id . '/' . $image->file_name);
            $image->delete();
        }

        foreach ($files as $file) {
            $image = new Image();
            $image->file_name = (string)Str::uuid() . '.' . $file->clientExtension();
            $file->storeAs($product->id, $image->file_name, config('filesystems.images_disk'));
            //path , name , disk
            $productImages->push($image);
        }

        $product->images()->saveMany($productImages);
        $product->refresh();
    }
}
