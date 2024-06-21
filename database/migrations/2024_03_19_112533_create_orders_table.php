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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID пользователя: users.id');
            $table->string('name')->nullable()->comment('Имя покупателя');
            $table->string('phone', 18)->nullable()->comment('Телефон покупателя');
            $table->string('email')->nullable()->comment('Email покупателя');
            $table->text('address')->nullable()->comment('Адрес доставки');
            $table->text('comment')->nullable()->comment('Комментарий к заказу');
            $table->string('domain')->nullable()->comment('Домен, на котором оформлен заказ');
            $table->unsignedBigInteger('items_sum')->nullable()->comment('Сумма товаров в корзине');
            $table->unsignedBigInteger('delivery_sum')->nullable()->comment('Стоимость доставки');
            $table->unsignedBigInteger('total_sum')->nullable()->comment('Сумма заказа общая');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
