<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, ShouldQueue, WithHeadings
{
    use Exportable;

    protected string $fechaInicio;
    protected string $fechaFinal;

    public function __construct(string $start, string $end)
    {

        $this->fechaInicio = $start;
        $this->fechaFinal = $end;

    }

    public function query()
    {

        return Product::query()->whereBetween('created_at', [$this->fechaInicio, $this->fechaFinal]);
    }

    public function headings(): array
    {
        return [
            'id',
            'code',
            'name',
            'description',
            'price',
            'discount',
            'maker',
            'quantity',
            'state',
            'sold_out_at',
            'deleted_at',
            'expired_at',
            'created_at',
            'updated_at',
        ];

    }
}
