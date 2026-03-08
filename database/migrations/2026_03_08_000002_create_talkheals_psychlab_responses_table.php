<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talkheals_psychlab_responses', function (Blueprint $table) {
            $table->id();
            $table->json('scores');
            $table->json('completed_games');
            $table->boolean('is_reviewed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talkheals_psychlab_responses');
    }
};
