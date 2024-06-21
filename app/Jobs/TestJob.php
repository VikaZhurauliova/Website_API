<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
use Illuminate\Support\Facades\Storage;

// Тест работы очереди
class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $text;
    public int $tries = 2;
    public bool $failOnTimeout = true;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function handle(): void
    {
        try {
            Storage::put('text.txt', date('Y-m-d H:i:s') . ' ' . $this->text);
        } catch(Exception $e) {
            $this->failed($e);
        }
    }

    public function failed($exception): void
{
        $exception->getMessage();
    }

}
