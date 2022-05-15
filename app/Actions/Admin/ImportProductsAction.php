<?php

namespace App\Actions\Admin;

use App\Imports\ProductsImport;
use App\Jobs\ImportProductsDone;
use App\Notifications\NotifyUserOfCompletedImport;

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
