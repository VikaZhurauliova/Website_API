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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_singular')->nullable()->comment('Название в единственном числе');
            $table->string('name_video_review')->nullable()->comment('Название блока с видеоотзывом');
            $table->boolean('is_video_review')->nullable()->comment('Показывать блок с видеоотзывами');
            $table->text('description_short')->nullable()->comment('Короткое описание');
            $table->text('description_full')->nullable()->comment('Полное описание');
            $table->text('description_app')->nullable()->comment('Описание для приложения');
            $table->string('miniature_large')->nullable()->comment('Миниатюра в большом меню');
            $table->string('miniature_mini')->nullable()->comment('Миниатюра в меню приложения');
            $table->string('additional_links')->nullable()->comment('Дополнительные ссылки (выше категории товаров)');
            $table->string('additional_links_images')->nullable()->comment('Дополнительные ссылки с Изображениями');
            $table->string('additional_links_video')->nullable()->comment('Дополнительные видео');
            $table->text('additional_text')->nullable()->comment('Дополнительный текст');
            $table->text('additional_links_2')->nullable()->comment('Дополнительный ссылки 2 (Ниже товаров категории)');

            $table->unsignedBigInteger('categories_type_id')->nullable()->comment('ID типа категории');
            $table->foreign('categories_type_id')->references('id')->on('categories_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
};
