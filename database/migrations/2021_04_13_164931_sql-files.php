<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SqlFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //TODO add files main
        // DB::unprepared(file_get_contents(database_path()."/seeders/sql-files/main.sql"));

        // DB::unprepared(file_get_contents(database_path()."/seeders/sql-files/item_db.sql"));

        // DB::unprepared(file_get_contents(database_path()."/seeders/sql-files/mob_db.sql"));

        // DB::unprepared(file_get_contents(database_path()."/seeders/sql-files/mob_db.sql"));

        // DB::unprepared(file_get_contents(database_path()."/seeders/sql-files/pt_br_translate_item_db.sql"));

        // DB::unprepared(file_get_contents(database_path()."/seeders/sql-files/pt_br_translate_mob_db.sql"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
