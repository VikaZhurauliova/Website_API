<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        try {
            // Связь новость - категория новости
            Schema::create('news_category', function (Blueprint $table) {
                $table->comment('Связь новость - категория новости');

                $table->unsignedBigInteger('news_id')->comment('Id новости: news.id');
                $table->unsignedBigInteger('category_id')->comment('Id категории: category_for_news.id');

                $table->foreign('news_id')->references('id')->on('news');
                $table->foreign('category_id')->references('id')->on('category_for_news');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('news_category');
        Schema::enableForeignKeyConstraints();
    }
};
