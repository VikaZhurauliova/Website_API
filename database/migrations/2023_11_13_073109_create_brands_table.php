<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Бренды
            Schema::create('brands', function (Blueprint $table) {
                $table->comment('Бренды');

                $table->id();
                $table->string('name')->nullable()->comment('Название бренда');
                $table->unsignedInteger('sort')->nullable()->comment('Сортировка');
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
        Schema::dropIfExists('brands');
        Schema::enableForeignKeyConstraints();
    }
};
