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
        Schema::rename('categories_type', 'category_types');
        Schema::table('category_types', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->renameColumn('order', 'sort');
        });
        DB::table('category_types')->insert([
            [
                'id' => 1,
                'name' => 'Категории каталога',
                'description' => 'Категории, которые видят клиенты на сайте в разделе «Каталог»',
                'sort' => 0
            ],
            [
                'id' => 2,
                'name' => 'Подкатегории каталога',
                'description' => 'Подкатегории, которые видят клиенты на сайте в разделе «Каталог»',
                'sort' => 10
            ],
            [
                'id' => 3,
                'name' => 'Сезонные категории',
                'description' => 'Категории, которые создаются для каких-то праздников, временных акций и тому подобного. Обычно доступны только по прямой ссылке.',
                'sort' => 20
            ],
            [
                'id' => 4,
                'name' => 'Тематические категории',
                'description' => 'Категории, созданные для SEO, директа, рекламы. Доступны только по прямой ссылке',
                'sort' => 30
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('category_types')->truncate();
        Schema::table('category_types', function (Blueprint $table) {
            $table->timestamps();
            $table->renameColumn('sort', 'order');
        });
        Schema::rename('category_types', 'categories_type');
    }
};
