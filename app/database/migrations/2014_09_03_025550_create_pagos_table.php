<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('papeleta');
			$table->string('cantidad');
			$table->string('pagoDe');
			$table->string('formaDePago');
			$table->string('tarjeta');
			$table->string('cupon');
			$table->string('comision');
			$table->string('usuario');
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
		Schema::drop('pagos');
	}

}
