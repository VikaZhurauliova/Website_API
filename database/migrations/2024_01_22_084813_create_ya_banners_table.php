<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @throws Exception
     */
    public function up(): void
    {
        try {
            Schema::create('banners', function (Blueprint $table) {
                $table->comment('Баннеры');

                $table->id();
                $table->string('name')->nullable()->comment('Название');
                $table->text('html')->nullable()->comment('Код');
                $table->integer('position')->nullable()->unsigned()->comment('Позиция');
                $table->integer('delay')->nullable()->unsigned()->comment('Задержка, сек');
                $table->dateTime('date_start')->nullable()->comment('Дата начала отображения');
                $table->dateTime('date_end')->nullable()->comment('Дата окончания отображения');
                $table->boolean('is_active')->nullable()->comment('Активность (архив)');
                $table->boolean('status')->nullable()->comment('Статус (публикация)');
                $table->string('image_preview')->nullable()->comment('Превью');
                $table->timestamps();
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
        Schema::dropIfExists('banners');
    }
};
