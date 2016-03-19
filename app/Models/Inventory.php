<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	public function item()
	{
		return $this->hasMany('Nixzen\Models\Item\Item', 'item_id');
	}

	public function branch()
	{}

	public function company()
	{}

	public function lot()
	{}

	public function bin()
	{}

	public function getOnHandQtyAttribute($value)
	{
			return $value;
	}

	public function writeIn($quantity)
	{
			$total = $this->onHandQty + $quantity;
			$this->update(['quantity' => $total]);
	}

	public function writeOut($quantity)
	{}
}
