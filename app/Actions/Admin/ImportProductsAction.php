<?php

namespace App\Actions\Admin;

use App\Imports\ProductsImport;
use App\Jobs\ImportProductsDone;

class ImportProductsAction
{
    public function execute($file)
    {
        $import = new ProductsImport();
        $import->queue($file)->chain([
            new ImportProductsDone(auth()->user()),
        ]);
    }
}
