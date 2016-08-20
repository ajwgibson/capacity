<?php

class Registration extends Eloquent {
	
	protected $table = 'registrations';

	protected $fillable = array('tickets', 'name', 'email_address');

	// Eager loading
    protected $with = array('booking');

	// Relationship: booking
	public function booking()
	{
		return $this->belongsTo('Booking');
	}

	// What is the name on the registration
    public function name()
    {
    	if ($this->booking) {
    		return $this->booking->first . ' ' . $this->booking->last;
    	} else {
    		return $this->name;
    	}
    }

    // What is the email on the registration
    public function email()
    {
        if ($this->email_address) return $this->email_address;
        if ($this->booking) return $this->booking->email;
        return '';
    }
}