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
        Schema::table('pages', function (Blueprint $table) {
            $table->renameColumn('use_form', 'isWithForm');
            $table->renameColumn('use_landing', 'isWithLanding');
        });
        Schema::table('page_region', function (Blueprint $table) {
            $table->renameColumn('use_form', 'isWithForm');
            $table->renameColumn('use_landing', 'isWithLanding');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->renameColumn('isWithForm', 'use_form');
            $table->renameColumn('isWithLanding', 'use_landing');
        });
        Schema::table('page_region', function (Blueprint $table) {
            $table->renameColumn('isWithForm', 'use_form');
            $table->renameColumn('isWithLanding', 'use_landing');
        });
    }
};
