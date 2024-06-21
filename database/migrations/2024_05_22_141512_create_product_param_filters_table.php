<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_param_filters', function (Blueprint $table) {
            $table->comment('Фильтры технических характеристик товаров');

            $table->unsignedBigInteger('product_param_id')->comment('Параметр товара: product_params.id');
            $table->foreign('product_param_id')->references('id')->on('product_params');

            $table->unsignedBigInteger('filter_id')->comment('Фильтр параметра товара: filters.id');
            $table->foreign('filter_id')->references('id')->on('filters');

            $table->unique(['product_param_id', 'filter_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('product_param_filters');
    }
};
