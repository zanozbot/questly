<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->integer('aid');
			$table->integer('uid')->nullable()->index('uid_idx');
			$table->integer('qid')->index('qid_idx');
			$table->integer('votes')->default(0);
			$table->text('content', 65535);
			$table->dateTime('timestamp');
			$table->primary(['aid', 'qid']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answers');
	}

}
