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
        Schema::create('categories_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название категории');
            $table->string('description')->comment('Описание категории')->nullable();
            $table->integer('order')->comment('Порядок категории')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_type');
    }
};
