<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameGameTableReleaseDateToReleaseYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
//     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->renameColumn('release_date', 'release_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->renameColumn('release_year', 'release_date');
        });
    }
}
