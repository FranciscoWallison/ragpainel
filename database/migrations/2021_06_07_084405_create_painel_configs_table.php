<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Config;

class CreatePainelConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('painel_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 40);
            $table->string('content', 100);
            $table->timestamps();
        });

        $config = new Config();
        $config->name = 'title';
        $config->content = 'RS CODE - Painel';
        $config->save();

        $config = new Config();
        $config->name = 'title_mini';
        $config->content = 'RS';
        $config->save();

        $config = new Config();
        $config->name = 'email';
        $config->content = 'rafael@rscode.com.br';
        $config->save();

        $config = new Config();
        $config->name = 'discord';
        $config->content = 'https://discord.gg/';
        $config->save();

        $config = new Config();
        $config->name = 'facebook';
        $config->content = 'https://www.facebook.com/';
        $config->save();

        $config = new Config();
        $config->name = 'color';
        $config->content = 'purple';
        $config->save();

        $config = new Config();
        $config->name = 'colorbg';
        $config->content = 'black';
        $config->save();

        $config = new Config();
        $config->name = 'levelvip';
        $config->content = 5;
        $config->save();

        $config = new Config();
        $config->name = 'leveladm';
        $config->content = 99;
        $config->save();

        $config = new Config();
        $config->name = 'levelgm';
        $config->content = 50;
        $config->save();

        $config = new Config();
        $config->name = 'levelcm';
        $config->content = 20;
        $config->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('painel_configs');
    }
}
