<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoodlegamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doodlegames', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('drawer_id');
            $table->integer('receiver_id');
            $table->integer('game_id');
            $table->integer('doodle_id');
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
		Schema::drop('doodlegames');
	}

}
