<?php

use App\Models\Page;
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
        Schema::create('page_templates', function (Blueprint $table) {
            $table->comment('Типы шаблонов страниц');
            $table->id();
            $table->string('name')->comment('Название шаблона');
        });

        DB::table('page_templates')->insert([
            ['name' => 'ckeditor'],
            ['name' => 'catalog'],
            ['name' => 'sale'],
            ['name' => 'newsList'],
        ]);

        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedBigInteger('template_id')->nullable()->comment('ID шаблона: page_templates.id')->after('status');
            $table->boolean('use_form')->nullable()->comment('Есть форма обратной связи')->after('template_id');
            $table->dropColumn('template');
        });

        Page::whereIn('id', [6, 10, 22])->update(['template_id' => 1, 'use_form' => 1]);
        Page::where('id', 7)->update(['template_id' => 2]);
        Page::whereIn('id', [21, 24])->update(['template_id' => 3]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_templates');
        Schema::table('pages', function (Blueprint $table) {
            $table->string('template')->nullable()->comment('Шаблон страницы')->after('status');
            $table->dropColumn(['template_id', 'use_form']);
        });
        Page::whereIn('id', [6, 10, 22])->update(['template' => 'ckeditor_with_form']);
        Page::where('id', 7)->update(['template' => 'catalog']);
        Page::whereIn('id', [21, 24])->update(['template' => 'actions']);
    }
};
