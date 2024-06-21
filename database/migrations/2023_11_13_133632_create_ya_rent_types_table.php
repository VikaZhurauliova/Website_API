<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * @throws Exception
     */
    public function up(): void
    {
        try {
            // Типы аренды
            Schema::create('rent_types', function (Blueprint $table) {
                $table->comment('Типы аренды');

                $table->id();
                $table->string('name')->nullable()->comment('Название типа аренды');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка');
            });

            DB::table('rent_types')->insert([
                [
                    'id' => 1,
                    'name' => 'VIP-Аренда на 1 месяц',
                    'sort' => 0
                ],
                [
                    'id' => 2,
                    'name' => 'VIP-Аренда на 3 месяца',
                    'sort' => 10
                ],
                [
                    'id' => 3,
                    'name' => 'Аренда 1 час',
                    'sort' => 20
                ],
                [
                    'id' => 4,
                    'name' => 'Аренда 1 день',
                    'sort' => 30
                ],
                [
                    'id' => 5,
                    'name' => 'Аренда 7 дней',
                    'sort' => 40
                ],
                [
                    'id' => 6,
                    'name' => 'Аренда на 1 месяц',
                    'sort' => 50
                ],
                [
                    'id' => 7,
                    'name' => 'Аренда на 3 месяца',
                    'sort' => 60
                ]
            ]);
        } catch (Exception $e) {
            $this->down();
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_types');
    }
};
