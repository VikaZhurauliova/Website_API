<?php

namespace App\Console\Commands\import;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MakeFoldersCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:make_storage_folders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаёт папки в storage';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Storage::makeDirectory(config('files.colorsFolder'));
        Storage::makeDirectory(config('files.bannersFolder'));

    }
}
