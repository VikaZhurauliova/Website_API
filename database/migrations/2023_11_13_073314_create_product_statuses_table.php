<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Статусы товара
            Schema::create('product_statuses', function (Blueprint $table) {
                $table->comment('Статусы товара');

                $table->id();
                $table->string('name')->nullable()->comment('Название статуса');
                $table->string('description')->nullable()->comment('Описание статуса');
                $table->timestamps();
            });

            DB::table('product_statuses')->insert([
                [
                    'id' => 1,
                    'name' => 'Опубликован',
                    'description' => 'Виден в поиске сайта, в каталогах и доступен для поисковиков',
                    'created_at' => now()
                ],
                [
                    'id' => 2,
                    'name' => 'Предварительный просмотр',
                    'description' => 'Виден только некоторым ролям, не виден клиентам',
                    'created_at' => now()
                ],
                [
                    'id' => 3,
                    'name' => 'По прямой ссылке без SEO',
                    'description' => 'Виден только по прямой ссылке, не виден поисковикам. Некоторые поисковики могут вносить страницу в свой индекс, не смотря ни на что',
                    'created_at' => now()
                ],
                [
                    'id' => 4,
                    'name' => 'По прямой ссылке + SEO',
                    'description' => 'Виден только по прямой ссылке и виден поисковикам',
                    'created_at' => now()
                ],
                [
                    'id' => 5,
                    'name' => 'Предзаказ',
                    'description' => 'Товара пока нет в наличии, но он опубликован и его можно предзаказать',
                    'created_at' => now()
                ],
                [
                    'id' => 6,
                    'name' => 'Скрыть цену',
                    'description' => 'Товар полностью опубликован, но цену возможно узнать только по телефону',
                    'created_at' => now()
                ],
                [
                    'id' => 7,
                    'name' => 'Снят с производства (Нет в наличии)',
                    'description' => 'Товар полностью опубликован, но имеет статус «Снят с произодства». Заказ невозможен',
                    'created_at' => now()
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('product_statuses');
        Schema::enableForeignKeyConstraints();
    }
};
