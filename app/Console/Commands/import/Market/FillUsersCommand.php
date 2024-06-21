<?php

namespace App\Console\Commands\import\Market;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FillUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:market_fill_users_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет таблицу пользователей для сайта market.ru';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        User::create([
            'email' => 'vizhuravleva19@gmail.com',
            'role' => 'admin',
            'phone' => '+375336828654',
            'password' => Hash::make('12345678'),
        ]);


        DB::connection('market_old')->table('users')->orderBy('id')->where('role', 'admin')->chunk(100, function (Collection $users) {
            foreach ($users as $user) {
                DB::table('users')->insert([
                    'first_name' => empty($user->fname) ? null : $user->fname,
                    'middle_name' => empty($user->mname) ? null : $user->mname,
                    'last_name' => empty($user->lname) ? null : $user->lname,
                    'email' => $user->email,
                    'password' => empty($user->passwordHash) ? null : $user->passwordHash,
                    'role' => $user->role === 'admin' ? 'admin' : 'user',
                    'phone' => empty($user->phone) ? null : $user->phone,
                    'customer_id' => empty($user->customer_id) ? null : $user->customer_id,
                    'created_at' => now()
                ]);
            }
        });

    }

}
