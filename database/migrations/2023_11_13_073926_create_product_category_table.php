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
            // Категории товара (связь товар-категория)
            Schema::create('product_category', function (Blueprint $table) {
                $table->comment('Категории товара (связь товар-категория)');

                $table->id();
                $table->unsignedBigInteger('product_id')->nullable()->comment('ID товара: products.id');
                $table->unsignedBigInteger('category_id')->nullable()->comment('ID категории: categories.id');

                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('product_category');
        Schema::enableForeignKeyConstraints();
    }
};
