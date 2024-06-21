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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['categories_type_id']);
            $table->renameColumn('categories_type_id', 'category_type_id');
            $table->foreign('category_type_id')->references('id')->on('category_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_type_id', function (Blueprint $table) {
            $table->dropForeign(['category_type_id']);
            $table->renameColumn('category_type_id', 'categories_type_id');
            $table->foreign('categories_type_id')->references('id')->on('category_types');
        });
    }
};
