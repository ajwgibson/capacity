<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailAddressToBookingsAndRegistrations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bookings', function(Blueprint $table)
		{
			$table->string('email', 254)->nullable();
		});

		Schema::table('registrations', function(Blueprint $table)
		{
			// Probably seems odd to use a different column name here, but it 
			// avoids some issues with queries and model building in the code :(
			$table->string('email_address', 254)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bookings', function(Blueprint $table)
		{
			$table->dropColumn('email');
		});

		Schema::table('registrations', function(Blueprint $table)
		{
			$table->dropColumn('email_address');
		});
	}

}
