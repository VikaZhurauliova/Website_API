<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;

// Обновление фронт проекта
class UpdateFrontJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $text;
    public int $tries = 2;
    public int $timeout = 3600;
    public bool $failOnTimeout = true;

    public function handle(): void
    {
        try {
            exec("runuser -l " . config('app-update.ssh-user') . " -c 'cd " . config('app-update.ssh-front-directory') . " && pm2 stop all; pm2 delete all; git restore .; git pull origin main; yarn set version stable; yarn build; pm2 start yarn --name website -- start'");
        } catch(Exception $e) {
            $this->failed($e);
        }
    }

    public function failed($exception): void
{
        $exception->getMessage();
    }

}
