<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingPvpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_pvp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('char_id');
            $table->string('char_name', 24);
            $table->integer('killed', false, true);
            $table->integer('died', false, true);
            $table->integer('point');
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
        Schema::dropIfExists('ranking_pvp');
    }
}
