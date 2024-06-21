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
        try {
            // Создаём новую таблицу пользователей
            Schema::create('users', function (Blueprint $table) {
                $table->comment('Пользователи');

                $table->id();
                $table->string('first_name')->nullable()->comment('Имя');
                $table->string('middle_name')->nullable()->comment('Отчество');
                $table->string('last_name')->nullable()->comment('Фамилия');
                $table->string('email')->comment('Email')->index();
                $table->string('password')->nullable()->comment('Пароль');
                $table->string('role')->nullable()->comment('Роль');
                $table->string('phone')->nullable()->comment('Телефон')->index();
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
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
};
