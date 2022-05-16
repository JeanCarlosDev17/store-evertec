<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ProductsImport implements WithHeadingRow, ToModel, WithUpserts, ShouldQueue, WithChunkReading
{
    use Importable;
    public function model(array $row)
    {
        return new Product([
            'code'=>$row['code'],
            'name'=>$row['name'],
            'description'=>$row['description'],
            'price'=>$row['price'],
            'discount'=>$row['discount'],
            'maker'=>$row['maker'],
            'quantity'=>$row['quantity'],
            'state'=>$row['state'],
            'sold_out_at'=>$row['sold_out_at'],
            'deleted_at'=>$row['deleted_at'],
            'expired_at'=>$row['expired_at'],
            'created_at'=>$row['expired_at'],
        ]);
    }

    public function uniqueBy(): string
    {
        return 'code';
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
