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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_active_land_video_desktop')->comment('Лендинг для десктопа активен')->after('land_video_file_id_desktop')->nullable();
            $table->boolean('is_active_land_video_mobile')->comment('Лендинг для телефона активен')->after('land_video_file_id_mobile')->nullable();
        });
        DB::table('products')->whereNotNull('land_video_file_id_desktop')->update(['is_active_land_video_desktop' => 1]);
        DB::table('products')->whereNotNull('land_video_file_id_mobile')->update(['is_active_land_video_mobile' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_active_land_video_desktop');
            $table->dropColumn('is_active_land_video_mobile');
        });
    }
};
