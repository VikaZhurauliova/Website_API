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
            Schema::table('favourites', function (Blueprint $table) {
                $table->string('guest_id')->nullable()->comment('ID гостя')->index()->change();
            });
            Schema::table('cart', function (Blueprint $table) {
                $table->string('guest_id')->nullable()->comment('ID гостя')->index()->change();
            });
            Schema::table('user_search_history', function (Blueprint $table) {
                $table->string('guest_id')->nullable()->comment('ID гостя')->index()->after('user_id');
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
        Schema::table('favourites', function (Blueprint $table) {
            $table->dropIndex("favourites_guest_id_index");
        });
        Schema::table('favourites', function (Blueprint $table) {
            $table->text('guest_id')->nullable()->comment('ID гостя')->change();
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->dropIndex("cart_guest_id_index");
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->text('guest_id')->nullable()->comment('ID гостя')->change();
        });
        Schema::table('user_search_history', function (Blueprint $table) {
            $table->dropIndex("user_search_history_guest_id_index");
        });
        Schema::table('user_search_history', function (Blueprint $table) {
            $table->dropColumn('guest_id');
        });
    }
};
