<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProductsExport implements FromQuery, ShouldQueue
{
    use Exportable;

    protected string $fechaInicio;
    protected string $fechaFinal;

    public function __construct( string $start, string $end)
    {

        $this->fechaInicio = $start;
        $this->fechaFinal = $end;

    }
    public function query()
    {

        return Product::query()->whereBetween('created_at', [$this->fechaInicio, $this->fechaFinal]);
    }
}
