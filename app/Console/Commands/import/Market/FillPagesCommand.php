<?php

namespace App\Console\Commands\import\Market;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FillPagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:market_fill_pages_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет таблицу pages для сайта market.ru';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::connection('market_old')->table('s_pages')->orderBy('id')->get()->each(function ($page) {
            DB::table('pages')->insert([
                'id' => $page->id,
                'name' => $page->name,
                'status' => empty($page->visible) ? null : 1,
                'body' => empty($page->body) ? null : $page->body,
            ]);
        });
    }
}
