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
            Schema::table('seo_regions', function (Blueprint $table) {
                $table->dropForeign(['seo_id']);
                $table->dropColumn('seo_id');
                $table->dropColumn('domain');
                $table->dropColumn('host');
                $table->dropTimestamps();
            });
            Schema::table('seo_regions', function (Blueprint $table) {
                $table->unsignedBigInteger('seo_id')->comment('id seo: seo.id')->after('id');
                $table->unsignedBigInteger('domain_id')->comment('id домена: domains.id')->after('seo_id');
                $table->foreign('domain_id')->references('id')->on('domains');
                $table->foreign('seo_id')->references('id')->on('seo');
                $table->unique(['domain_id', 'url']);
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
        Schema::table('seo_regions', function (Blueprint $table) {
            $table->dropForeign(['domain_id']);
            $table->dropForeign(['seo_id']);
            $table->dropUnique(['domain_id', 'url']);
            $table->dropColumn('seo_id');
            $table->dropColumn('domain_id');
        });
        Schema::table('seo_regions', function (Blueprint $table) {
            $table->unsignedBigInteger('seo_id')->nullable()->comment('id адреса: seo.id')->after('id');
            $table->string('domain')->comment('Домен')->after('seo_id');
            $table->string('host')->comment('Host');
            $table->foreign('seo_id')->references('id')->on('seo');
            $table->timestamps();
        });
    }
};
