<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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
}


