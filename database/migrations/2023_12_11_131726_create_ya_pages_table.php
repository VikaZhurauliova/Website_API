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
            // Страницы
            Schema::create('pages', function (Blueprint $table) {
                $table->comment('Страницы');

                $table->id();
                $table->string('name')->nullable()->comment('Название');
                $table->tinyInteger('status')->nullable()->unsigned()->default(1)->comment('Статус');
                $table->string('template')->nullable()->comment('Имя шаблона');
                $table->text('teaser')->nullable()->comment('Тизер');
                $table->text('body')->nullable()->comment('Содержание (видно, если не прикреплён шаблон)');
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
        Schema::dropIfExists('pages');
    }
};
