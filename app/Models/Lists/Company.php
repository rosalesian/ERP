<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	public function branch()
	{
		return $this->hasMany('Branch');
	}
	
	public function item()
	{
		return $this->hasMany('Item');
	}

	public function vendor()
	{
		return $this->hasMany('Vendor');
	}
}
