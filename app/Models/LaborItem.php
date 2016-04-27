<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class LaborItem extends Model {

	protected $table = 'labor_items';
	protected $fillable = [
			'joborder_id',
			'item_id',
			'jobtype_id',
			'created_by',
			'no_of_days',
			'updated_by',
			'created_at',
			'updated_at'
		];
	
	protected $primary_key = 'id';
	
	//change name to item_id
	public function item(){
		return $this->belongsTo('Nixzen\Models\Item', 'item_id');
	}
	//add Item for name space
	public function jobOrderType(){
		return $this->belongsTo('Nixzen\Models\Item\JobOrderType', 'jobtype_id');
	}
	
	public function jobOrder(){
		return $this->belongsTo('Nixzen\Models\Item\JobOrder', 'joborder_id');
	}


	static function addLaborItem($data_labor_costs, $id)
	{
		//labor cost data
		$result_labor = [];
		$labor_cast_data = (array) json_decode($data_labor_costs, true);
		foreach($labor_cast_data as $data_labor) {
				$temp = [];
				$temp['joborder_id'] = $id;
				$temp['item_id'] = $data_labor['item_id'];
				$temp['jobtype_id'] = $data_labor['jobtype_id'];
				$temp['no_of_days'] = $data_labor['no_of_days'];
				$temp['created_by'] = 1;
				$temp['updated_by'] = 1;
				$temp['created_at'] = date('Y-m-d h:i:s');
				$temp['updated_at'] = date('Y-m-d h:i:s');
				$result_labor[] = $temp;
			}
		
		return LaborItem::insert($result_labor);
	}
}
