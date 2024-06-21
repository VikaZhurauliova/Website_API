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
            // Товары - новая таблица
            Schema::create('products', function (Blueprint $table) {
                $table->comment('Товары');

                $table->id();
                $table->unsignedInteger('price')->nullable()->comment('Цена');
                $table->unsignedInteger('price_promotion')->nullable()->comment('Цена по акции');
                $table->unsignedInteger('price_preorder')->nullable()->comment('Цена предзаказа');
                $table->string('name')->nullable()->comment('Название товара');
                $table->string('slogan_text')->nullable()->comment('Слоган');
                $table->string('slogan_font_size', 50)->nullable()->comment('Размер шрифта слогана');
                $table->string('slogan_color', 50)->nullable()->comment('Код цвета слогана');
                $table->unsignedBigInteger('brand_id')->nullable()->comment('Бренд: brands.id');
                $table->string('model')->nullable()->comment('Модель');
                $table->string('short_name')->nullable()->comment('Короткое название');
                $table->string('system_name')->nullable()->comment('Системное название');
                $table->integer('popularity')->nullable()->comment('Популярность');
                $table->unsignedBigInteger('status_id')->nullable()->comment('Статус: product_status.id');
                $table->string('note')->nullable()->comment('Примечание');
                $table->unsignedBigInteger('land_video_desktop_file_id')->nullable()->comment('Видео десктоп в лендинге: files.id');
                $table->unsignedBigInteger('land_video_mobile_file_id')->nullable()->comment('Видео мобайл в лендинге: files.id');
                $table->unsignedBigInteger('category_compare_id')->nullable()->comment('Категория для сравнения: categories.id');
                $table->text('text_short')->nullable()->comment('Короткое описание (фид для Яндекс)');
                $table->text('text_full')->nullable()->comment('Полное описание (если лендинга нет — выводится это описание)');
                $table->text('text_app')->nullable()->comment('Описание для приложения');
                $table->string('text_benefit')->nullable()->comment('Фраза о выгоде в год');
                $table->unsignedBigInteger('category_breadcrumbs_id')->nullable()->comment('Категория для хлебных крошек: categories.id');
                $table->unsignedBigInteger('category_feed_id')->nullable()->comment('Категория для фида: categories.id');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('brand_id')->references('id')->on('brands');
                $table->foreign('status_id')->references('id')->on('product_statuses');
                $table->foreign('land_video_desktop_file_id')->references('id')->on('files');
                $table->foreign('land_video_mobile_file_id')->references('id')->on('files');
                $table->foreign('category_compare_id')->references('id')->on('categories');
                $table->foreign('category_breadcrumbs_id')->references('id')->on('categories');
                $table->foreign('category_feed_id')->references('id')->on('categories');
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
        Schema::dropIfExists('products');
        Schema::enableForeignKeyConstraints();
    }
};
