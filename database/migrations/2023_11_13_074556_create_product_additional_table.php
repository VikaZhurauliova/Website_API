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
            // С этим товаром покупают
            Schema::create('product_additional', function (Blueprint $table) {
                $table->comment('С этим товаром покупают');

                $table->id();
                $table->unsignedBigInteger('product_id')->nullable()->comment('ID товара: products.id');
                $table->unsignedBigInteger('relation_id')->nullable()->comment('ID связанного товара: products.id');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка');
                $table->string('type')->nullable()->comment('Место: landing, basket');

                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('relation_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_additional');
        Schema::enableForeignKeyConstraints();
    }
};
