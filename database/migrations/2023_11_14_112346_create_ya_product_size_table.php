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
            Schema::create('product_size', function (Blueprint $table) {
                $table->comment('Размеры товаров');

                $table->id();
                $table->unsignedBigInteger('product_id')->nullable()->comment('Товар: products.id');
                $table->unsignedBigInteger('size_id')->nullable()->comment('Размер: sizes.id');
                $table->unsignedInteger('price')->nullable()->comment('Цена');
                $table->unsignedInteger('price_promotion')->nullable()->comment('Цена по акции');
                $table->unsignedInteger('price_preorder')->nullable()->comment('Цена предзаказа');

                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('size_id')->references('id')->on('sizes');
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
        Schema::dropIfExists('product_size');
        Schema::enableForeignKeyConstraints();
    }
};
