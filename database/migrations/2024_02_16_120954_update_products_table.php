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
            $table->renameColumn('land_video_desktop_file_id', 'land_video_file_id_desktop');
            $table->renameColumn('land_video_mobile_file_id', 'land_video_file_id_mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('land_video_file_id_desktop', 'land_video_desktop_file_id');
            $table->renameColumn('land_video_file_id_mobile', 'land_video_mobile_file_id');
        });
    }
};
