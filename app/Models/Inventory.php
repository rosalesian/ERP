<?php namespace Nixzen\Models;

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

	public function scopeOfItem($query, $item)
	{
		return $query->where('item_id', $item);
	}

	public function scopeInBranch($queary, $item)
	{
		return $query->where('branch_id', $location);
	}

	public function scopeInBin($query, $bin)
	{
		return $query->where('bin_id', $bin);
	}

	public function scopeInLot($query, $lot)
	{
		return $query->where('lot_id', $lot);
	}
}
