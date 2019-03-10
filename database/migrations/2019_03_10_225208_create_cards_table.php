<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->json('attributes');
            $table->string('class');
            $table->string('race');
            $table->string('sub_race');
            $table->integer('health_point');
            $table->integer('mana_point')->nullable();
            $table->integer('constitution');
            $table->double('wallet')->default(0);
            $table->double('experience')->default(0);
            $table->text('description')->nullable();
            $table->string('expertise')->nullable();
            $table->string('combat_style')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
