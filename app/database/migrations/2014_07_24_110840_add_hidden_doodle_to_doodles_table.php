<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddHiddenDoodleToDoodlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('doodles', function(Blueprint $table)
		{
			$table->integer('hidden_doodle_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('doodles', function(Blueprint $table)
		{
            $table->deleteColumn('hidden_doodle_id');
		});
	}

}
