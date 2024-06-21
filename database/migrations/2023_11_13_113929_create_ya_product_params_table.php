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
            // Технические характеристики товаров - новая таблица
            Schema::create('product_params', function (Blueprint $table) {
                $table->comment('Технические характеристики товаров');

                $table->id();
                $table->text('parameter')->nullable()->comment('Название параметра');
                $table->text('filter')->nullable()->comment('Значение фильтра');
                $table->text('value')->nullable()->comment('Значение параметра');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка');
                $table->boolean('is_active')->nullable()->default(1)->comment('Активность');
                $table->unsignedBigInteger('product_id')->nullable()->comment('Товар: products.id');

                $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_params');
        Schema::enableForeignKeyConstraints();
    }
};
