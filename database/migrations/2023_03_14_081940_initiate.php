<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                  ->unique();;
            $table->integer('player_limit')
                  ->default(5);
            $table->timestamps();
        });

        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                  ->unique();
            $table->timestamps();
        });

        Schema::create('competition_player', function (Blueprint $table) {
            $table->id();
            $table->integer('competition_id');
            $table->integer('player_id');
            $table->unique([
                'competition_id',
                'player_id'
            ]);
            $table->foreign('competition_id')
                  ->references('id')
                  ->on('competitions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('player_id')
                  ->references('id')
                  ->on('players')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->integer('score')
                  ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('competition_player');
        Schema::drop('players');
        Schema::drop('competitions');
    }
};
