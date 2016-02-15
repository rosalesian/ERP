<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	public function item()
	{
		return $this->hasMany('Nixzen\Models\Item\Item', 'item_id');
	}
}
