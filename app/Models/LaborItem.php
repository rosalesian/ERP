<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class LaborItem extends Model {

	protected $table = 'labor_items';
	
	protected $primary_key = 'id';
	
	public function item(){
		return $this->belongsTo('Nixzen\Models\Item', 'name');
	}
	
	public function jobOrderType(){
		return $this->belongsTo('Nixzen\Models\JobOrderType', 'jobtype_id');
	}
	
	public function jobOrder(){
		return $this->belongsTo('Nixzen\Models\JobOrder', 'joborder_id');
	}
}
