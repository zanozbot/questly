<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comments', function(Blueprint $table)
		{
			$table->foreign('aid', 'aid_comment')->references('aid')->on('answers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('qid', 'qid_comment')->references('qid')->on('questions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('uid', 'uid_comment')->references('uid')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comments', function(Blueprint $table)
		{
			$table->dropForeign('aid_comment');
			$table->dropForeign('qid_comment');
			$table->dropForeign('uid_comment');
		});
	}

}
