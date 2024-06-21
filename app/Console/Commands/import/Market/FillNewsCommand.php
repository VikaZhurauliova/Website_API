<?php

namespace App\Console\Commands\import\Market;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FillNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:market_fill_news_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет таблицу новостей для сайта market.ru';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::connection('market_old')->table('s_news')->orderBy('id')->chunk(100, function (Collection $news) {
            foreach ($news as $new) {

                DB::table('news')->insert([
                    'id' => $new->id,
                    'title' => $new->name,
                    'teaser' => $new->annotation,
                    'body' => $new->text,
                    'status' => $new->visible,
                    'updated_at' => $new->	updated,
                    'created_at' => now()
                ]);
            }
        });

    }
}
