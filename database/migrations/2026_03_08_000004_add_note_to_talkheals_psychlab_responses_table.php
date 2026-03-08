<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('talkheals_psychlab_responses', function (Blueprint $table) {
            $table->text('note')->nullable()->after('completed_games');
        });
    }

    public function down(): void
    {
        Schema::table('talkheals_psychlab_responses', function (Blueprint $table) {
            $table->dropColumn('note');
        });
    }
};
