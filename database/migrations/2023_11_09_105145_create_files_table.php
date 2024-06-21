<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * @throws Exception
     */
    public function up(): void
    {
        try {
            // Файлы
            Schema::create('files', function (Blueprint $table) {
                $table->comment('Загруженные файлы');

                $table->id();
                $table->string('src')->nullable()->comment('Путь к загруженному файлу');
                $table->string('type', 50)->nullable()->comment('Тип файла условный');
                $table->string('name_init')->nullable()->comment('Изначальное имя файла');
                $table->unsignedInteger('width')->nullable()->comment('Ширина для фото или видео');
                $table->unsignedInteger('height')->nullable()->comment('Высота для фото или видео');
                $table->string('preview')->nullable()->comment('Путь к превью');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('files');
        Schema::enableForeignKeyConstraints();
    }
};
