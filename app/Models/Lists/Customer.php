<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

	public function branch()
	{
		return $this->belongsTo('Branch');
	}
	
	public function company()
	{
		return $this->belongsTo('Company');	
	}

}
