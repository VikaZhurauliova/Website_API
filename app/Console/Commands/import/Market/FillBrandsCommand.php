<?php

namespace App\Console\Commands\import\Market;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FillBrandsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:market_fill_brands_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет таблицу brands для сайта market.ru';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::connection('market_old')->table('s_brands')->orderBy('id')->chunk(100, function (Collection $brands) {
            foreach ($brands as $brand) {

                DB::table('brands')->insert([
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'created_at' => now()
                ]);
            }
        });

    }
}
