<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // SEO сайта
            Schema::create('seo', function (Blueprint $table) {
                $table->comment('SEO сайта');

                $table->id();
                $table->string('url')->nullable()->unique()->comment('URL');
                $table->string('title')->nullable()->comment('Заголовок страницы');
                $table->string('keywords')->nullable()->comment('Ключевые слова');
                $table->string('description')->nullable()->comment('Описание страницы');
                $table->bigInteger('seoble_id')->nullable()->comment('ID сущности, с которой связана запись');
                $table->string('seoble_type')->nullable()->comment('Тип сущности, с которой связана запись');
                $table->boolean('status')->nullable()->default(1)->comment('Статус: опубликован - не опубликован');
                $table->string('canonical')->nullable()->comment('Что-то неизвестное со старого сайта');

                $table->index(['seoble_type', 'seoble_id']);
            });
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
        Schema::dropIfExists('seo');
    }
};
