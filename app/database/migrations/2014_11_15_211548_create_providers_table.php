<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvidersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function (Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->text('description')->nullable();
			$table->string('email')->nullable();
			$table->integer('phone1')->nullable();
			$table->integer('phone2')->nullable();
			$table->text('address')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('providers');
	}

}