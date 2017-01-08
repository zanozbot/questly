<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('answers', function(Blueprint $table)
		{
			$table->foreign('qid', 'qid_answer')->references('qid')->on('questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('uid', 'uid_answer')->references('uid')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('answers', function(Blueprint $table)
		{
			$table->dropForeign('qid_answer');
			$table->dropForeign('uid_answer');
		});
	}

}
