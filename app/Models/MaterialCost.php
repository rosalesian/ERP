<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class MaterialCost extends Model {

	protected $table = 'material_costs';

	public function joborder()
	{
		return $this->belongsTo('Nixzen\JobOrder', 'joborder_id');
	}

	public function item()
	{
		return $this->belongsTo('Nixzen\Item', 'name');
	}

	public function unit()
	{
		return $this->belongsTo('Nixzen\Unit', 'units_id');
	}

}
