<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Новости
            Schema::create('news', function (Blueprint $table) {
                $table->comment('Новости');

                $table->id();
                $table->string('title')->nullable()->comment('Заголовок страницы');
                $table->text('teaser')->nullable();
                $table->longText('body')->nullable();
                $table->boolean('status')->nullable()->default(1);
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
        Schema::dropIfExists('news');
    }
};
