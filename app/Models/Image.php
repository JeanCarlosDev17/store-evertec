<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Image extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function url(): string
    {
//        dump(config('filesystems.images_disk'));
//        dump(Storage::disk(config('filesystems.images_disk'))->url("{$this->product_id}/{$this->file_name}"));
        return Storage::disk(config('filesystems.images_disk'))->url("{$this->product_id}/{$this->file_name}");
    }
    public function getExtensionImage(): string
    {

        $infoPath = pathinfo(public_path($this->url()));
        $extension = $infoPath['extension'];

//        $file= Storage::disk(config('filesystems.images_disk'))->get("{$this->product_id}/{$this->file_name}");
        return $extension;
    }

    public function getFileName():string
    {
//        dump("nombre con extension",pathinfo(public_path($this->url()))['basename']);
        $filename=str_replace('.'.$this->getExtensionImage(),'',pathinfo(public_path($this->url()))['basename']);
//        dump("el nombre es ",$filename);
        return $filename;
    }

    public function getFileSize():string
    {
//        $size = Storage::size('file.jpg');
        $size= Storage::disk(config('filesystems.images_disk'))->size("{$this->product_id}/{$this->file_name}");

        return $size;
    }public function getFileMime():string
    {


        return $mimetype = Storage::disk(config('filesystems.images_disk'))->mimeType("{$this->product_id}/{$this->file_name}");
    }
}


