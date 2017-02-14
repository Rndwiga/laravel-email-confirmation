<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailConfirmationTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_confirmations', function (Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->boolean('is_confirmed')->default(FALSE)->index();
			$table->string('hash')->nullable()->index();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on( 'users' )->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('email_confirmations');
	}
}
