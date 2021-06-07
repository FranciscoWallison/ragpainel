<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingWoeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranking_woe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('guild_id');
            $table->string('guild_name', 50);
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
        Schema::dropIfExists('ranking_woe');
    }
}
