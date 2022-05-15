<?php

namespace App\Jobs;

use App\Notifications\ExportProductsDone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyCompleteExportToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $filePath;

    public function __construct( $user,string $filePath)
    {
        $this->user=$user;
        $this->filePath=$filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->user->notify(new ExportProductsDone($this->filePath));
        \Log::info('Finalizo la exportacion');
        \Log::info('Notificacion enviada a'. $this->user->email);
        \Log::info('con el archivo '. $this->filePath);
    }
}
