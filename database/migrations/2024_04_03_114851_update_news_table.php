<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->comment('Журнал');
            $table->integer('type')->nullable()->comment('Что-то неизвестное со старого сайта')->default(1)->change();
        });

        // Обновляем все записи в таблице, чтобы установить значение 1 для колонки type
        DB::table('news')->update(['type' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
