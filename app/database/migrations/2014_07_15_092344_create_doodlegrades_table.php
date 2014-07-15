<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoodlegradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doodlegrades', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('doodle_id');
            $table->integer('judge_id');
            $table->integer('grade');
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
		Schema::drop('doodlegrades');
	}

}
