<?php

View::composer(array('home', 'registrations.register'), function($view)
{
    $all       = Registration::get()->sum('tickets');
	$preBooked = Registration::whereNotNull('booking_id')->sum('tickets');
	$expected  = Booking::get()->sum('tickets');

	$view->with('registration_count_total', $all)
         ->with('expected_count',           $expected)
		 ->with('still_to_register',        $expected - $preBooked);
});
