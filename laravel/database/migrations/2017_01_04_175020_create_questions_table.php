<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->integer('qid', true);
			$table->integer('uid')->nullable()->index('uid_idx');
			$table->integer('votes')->default(0);
			$table->integer('views')->default(0);
			$table->integer('replies')->default(0);
			$table->string('title', 128);
			$table->text('content', 65535);
			$table->dateTime('timestamp');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}
