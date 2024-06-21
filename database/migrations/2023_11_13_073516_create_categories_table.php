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
            // Категории товаров
            Schema::create('categories', function (Blueprint $table) {
                $table->comment('Категории товаров');

                $table->id();
                $table->unsignedBigInteger('parent_id')->nullable()->comment('ID родительской категории: categories.id');
                $table->string('name')->nullable()->comment('Название категории');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка');

                $table->timestamps();
                $table->softDeletes();
            });

            // Foreign key parent
            Schema::table('categories', function (Blueprint $table) {
                $table->foreign('parent_id')->references('id')->on('categories');
            });

        } catch (Exception $e) {
            $this->down();
            throw $e;
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('categories');
        Schema::enableForeignKeyConstraints();
    }
};
