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
        Schema::create('page_region', function (Blueprint $table) {
            $table->comment('Перекрытия для страниц');

            $table->id();

            $table->tinyInteger('status')->nullable()->unsigned()->default(1)->comment('Статус');
            $table->string('template')->nullable()->comment('Имя шаблона');
            $table->text('teaser')->nullable()->comment('Тизер');
            $table->text('body')->nullable()->comment('Содержание (видно, если не прикреплён шаблон)');

            $table->unsignedBigInteger('domain_id')->nullable()->comment('ID домена');
            $table->foreign('domain_id')->references('id')->on('domains');

            $table->unsignedBigInteger('page_id')->nullable()->comment('ID страницы');
            $table->foreign('page_id')->references('id')->on('pages');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('page_region');
    }
};
