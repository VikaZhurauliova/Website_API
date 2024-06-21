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
        Schema::create('colors', function (Blueprint $table) {
            $table->comment('Цвета');

            $table->id();
            $table->string('name')->unique()->comment('Название цвета');
            $table->string('code')->comment('Код цвета');
            $table->string('image')->nullable()->comment('Картинка');
            $table->boolean('is_code')->comment('Код выбран');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
