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

    public const FILE_DISK = 'filesystems.images_disk';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function url(): string
    {
        return Storage::disk(config(FILE_DISK))->url("{$this->product_id}/{$this->file_name}");
    }
    public function getExtensionImage(): string
    {
        $infoPath = pathinfo(public_path($this->url()));
        return $infoPath['extension'];
    }

    public function getFileName(): string
    {
        $filename = str_replace('.' . $this->getExtensionImage(), '', pathinfo(public_path($this->url()))['basename']);
        return $filename;
    }

    public function getFileSize(): string
    {
        return Storage::disk(config(FILE_DISK))->size("{$this->product_id}/{$this->file_name}");
    }
    public function getFileMime(): string
    {
        return  Storage::disk(config(FILE_DISK))->mimeType("{$this->product_id}/{$this->file_name}");
    }
}
