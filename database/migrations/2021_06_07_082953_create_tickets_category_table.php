<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TicketsCategory;

class CreateTicketsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 40);
            $table->timestamps();
        });

        $names = ['Doações', 'Suporte', 'Bug', 'Denúncia'];

        foreach ($names as $name) {
            $category = new TicketsCategory();
            $category->name = $name;
            $category->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets_category');
    }
}
