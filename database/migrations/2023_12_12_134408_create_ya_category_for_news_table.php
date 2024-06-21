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
            // Категории новостей
            Schema::create('category_for_news', function (Blueprint $table) {
                $table->comment('Категории новостей');

                $table->id();
                $table->string('name')->nullable()->comment('Название категории');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка');
                $table->boolean('active')->nullable()->default(1)->comment('Активность');
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
        Schema::dropIfExists('category_for_news');
        Schema::enableForeignKeyConstraints();
    }

};
