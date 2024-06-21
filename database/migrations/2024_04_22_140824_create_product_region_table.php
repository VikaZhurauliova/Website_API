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
        Schema::create('product_region', function (Blueprint $table) {
            $table->id();
            $table->text('text_short')->nullable()->comment('Короткое описание');
            $table->text('text_full')->nullable()->comment('Полное описание');

            $table->unsignedBigInteger('domain_id')->nullable()->comment('ID домена');
            $table->foreign('domain_id')->references('id')->on('domains');

            $table->unsignedBigInteger('product_id')->nullable()->comment('ID товара');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_region');
    }
};
