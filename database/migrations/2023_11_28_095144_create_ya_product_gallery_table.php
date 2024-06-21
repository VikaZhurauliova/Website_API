<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @throws Exception
     */
    public function up(): void
    {
        try {
            // Создаём таблицу галереи товаров (общую для фото и видео)
            Schema::create('product_gallery', function (Blueprint $table) {
                $table->comment('Галерея фото и видео товаров');

                $table->id();
                $table->unsignedBigInteger('product_id')->nullable()->comment('Товар: products.id');
                $table->enum('type', ['photo', 'video'])->comment('Тип файла: фото или видео');
                $table->boolean('is_active')->nullable()->comment('Опубликовано (общее для фото и видео)');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка (общее для фото и видео)');

                $table->string('photo_file_name_orig')->nullable()->comment('Исходное имя файла (фото)');
                $table->string('photo_title')->nullable()->comment('Заголовок (фото)');
                $table->string('photo_alt')->nullable()->comment('Подзаголовок (фото)');
                $table->boolean('photo_is_feed')->nullable()->comment('Рекламный фид (фото)');

                $table->string('video_youtube_link')->nullable()->comment('Ссылка на видео на YouTube (видео)');
                $table->string('video_search_text')->nullable()->comment('Текст для поиска (видео)');
                $table->string('video_description')->nullable()->comment('Описание (видео)');
                $table->boolean('video_instruction')->nullable()->comment('Инструкция (видео)');
                $table->boolean('video_stars')->nullable()->comment('Звёзды (видео)');
                $table->boolean('video_beauty_slide')->nullable()->comment('Бьюти слайд (видео)');

                $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_gallery');
        Schema::enableForeignKeyConstraints();
    }
};
