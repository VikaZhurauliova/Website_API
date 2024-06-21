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
            // Аренда товаров - новая таблица
            Schema::create('product_rent', function (Blueprint $table) {
                $table->comment('Аренда товаров');

                $table->id();
                $table->unsignedBigInteger('product_id')->nullable()->comment('Товар: products.id');
                $table->unsignedBigInteger('rent_id')->nullable()->comment('Тип аренды: rent_types.id');
                $table->unsignedInteger('price')->nullable()->comment('Цена');
                $table->unsignedInteger('price_promotion')->nullable()->comment('Цена по акции');
                $table->unsignedInteger('price_preorder')->nullable()->comment('Цена предзаказа');

                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('rent_id')->references('id')->on('rent_types');
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
        Schema::dropIfExists('product_rent');
        Schema::enableForeignKeyConstraints();
    }
};
