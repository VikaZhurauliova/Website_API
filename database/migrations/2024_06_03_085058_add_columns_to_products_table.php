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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('isWithLanding')->nullable()->comment('Использовать лендинг')->after('note');
            $table->string('landingUrl')->nullable()->comment('URL лендинга')->after('isWithLanding');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('isWithLanding', 'landingUrl');
        });
    }
};
