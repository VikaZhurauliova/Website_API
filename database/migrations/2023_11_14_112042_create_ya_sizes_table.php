<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @throws Exception
     */
    public function up(): void
    {
        try {
            // Типы аренды
            Schema::create('sizes', function (Blueprint $table) {
                $table->comment('Размеры');

                $table->id();
                $table->string('name')->nullable()->comment('Название размера');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка');
            });

            DB::table('sizes')->insert([
                [
                    'id' => 1,
                    'name' => 'S',
                    'sort' => 0
                ],
                [
                    'id' => 2,
                    'name' => 'S/M',
                    'sort' => 10
                ],
                [
                    'id' => 3,
                    'name' => 'M',
                    'sort' => 20
                ],
                [
                    'id' => 4,
                    'name' => 'L',
                    'sort' => 30
                ],
                [
                    'id' => 5,
                    'name' => 'L/XL',
                    'sort' => 40
                ],
                [
                    'id' => 6,
                    'name' => 'XL',
                    'sort' => 50
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
        Schema::dropIfExists('sizes');
    }
};
