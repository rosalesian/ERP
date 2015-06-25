<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	public function item()
	{
		return $this->hasMany('Item');
	}
}
