<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStatusColumnToGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->integer('status');

            // If status = 0, it is a new game
            // If status = 1, player 1 draws a penis
            // If status = 2, player 2 hide the penis
            // If status = 3, player 1 grade it and status is set to 1

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games', function(Blueprint $table)
		{
			$table->deleteColumt('status');
		});
	}

}
