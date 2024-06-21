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
        Schema::create('category_region', function (Blueprint $table) {
            $table->id();
            $table->text('description_short')->nullable()->comment('Короткое описание');
            $table->text('description_full')->nullable()->comment('Полное описание');

            $table->unsignedBigInteger('domain_id')->nullable()->comment('ID домена');
            $table->foreign('domain_id')->references('id')->on('domains');

            $table->unsignedBigInteger('category_id')->nullable()->comment('ID категории');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_region');
    }
};
