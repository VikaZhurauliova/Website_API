<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @throws Exception
     */
    public function up(): void
    {
        try {
            Schema::create('user_search_history', function (Blueprint $table) {

                $table->id();
                $table->unsignedBigInteger('user_id')->nullable()->comment('ID пользователя');
                $table->text('text')->nullable()->comment('Поисковая фраза');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_search_history');
    }
};
