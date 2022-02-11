<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function url(): string
    {
        return Storage::disk(config('filesystems.images_disk'))->url("{$this->product_id}/{$this->file_name}");
    }
}
