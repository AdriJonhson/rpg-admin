<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRpgIdInRpgPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rpg_players', function (Blueprint $table) {
            $table->unsignedInteger('rpg_id');

            $table->foreign('rpg_id')->references('id')->on('rpgs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rpg_players', function (Blueprint $table) {
            $table->dropColumn(['rpg_id']);
        });
    }
}
