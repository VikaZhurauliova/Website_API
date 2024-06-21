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
        DB::table('product_params')->truncate();
        Schema::table('product_params', function (Blueprint $table) {
            $table->comment('Технические характеристики товаров');

            $table->dropColumn(['parameter', 'filter', 'is_active']);

            $table->unsignedBigInteger('param_id')->comment('Параметр товара: params.id');
            $table->foreign('param_id')->references('id')->on('params');

            $table->unique(['product_id', 'param_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
