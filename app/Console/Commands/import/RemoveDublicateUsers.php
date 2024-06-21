<?php

namespace App\Console\Commands\import;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveDublicateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:remove_dublicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаление дубликатов пользователей по номеру телефона и email';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $duplicatesByPhone = DB::table('users')
            ->select('phone', DB::raw('MIN(id) as min_id'))
            ->groupBy('phone')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicatesByPhone as $duplicate) {
            DB::table('users')
                ->where('phone', $duplicate->phone)
                ->where('id', '<>', $duplicate->min_id)
                ->delete();
        }

        // Удаление дубликатов по колонке 'email'
        $duplicatesByEmail = DB::table('users')
            ->select('email', DB::raw('MIN(id) as min_id'))
            ->groupBy('email')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicatesByEmail as $duplicate) {
            DB::table('users')
                ->where('email', $duplicate->email)
                ->where('id', '<>', $duplicate->min_id)
                ->delete();
        }
    }
}
