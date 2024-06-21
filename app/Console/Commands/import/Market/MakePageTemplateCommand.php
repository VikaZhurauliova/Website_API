<?php

namespace App\Console\Commands\import\Market;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MakePageTemplateCommand extends Command
{

    protected $signature = 'import:make_market_page_type';
    protected $description = 'Создаёт тип страницы Каталог в Market ';

    public function handle(): void
    {
        DB::table('pages')->where('id',7)->update(['template' => 'catalog']);
        DB::table('pages')->where('id',18)->update(['template' => 'newsList']);
    }

}
