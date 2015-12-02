<?php

View::composer(array('home', 'registrations.register'), function($view)
{
	$all = Registration::get()->sum('tickets');
	$expected = Booking::get()->sum('tickets');

	$view->with('registration_count_total', $all)
		 	 ->with('expected_count', $expected);
});
