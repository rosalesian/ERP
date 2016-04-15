<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialCost extends Model {

	protected $table = 'material_costs';
	protected $fillable = [
			'joborder_id',
			'item_id',
			'units_id',
			'quantity'
		];

	//add relastionship for joborder
	public function joborder()
	{
		return $this->belongsTo('Nixzen\Models\Item\JobOrder', 'joborder_id');
	}
	//add reslastionship for items
	//modified add Models names space
	public function item()
	{
		return $this->belongsTo('Nixzen\Models\Item', 'item_id');
	}

	public function unit()
	{
		return $this->belongsTo('Nixzen\Models\Unit', 'id');
	}

	static function addMaterialCost($data_items, $id)
	{
		//labor cost data
		$data_result = [];
		$manage = (array) json_decode($data_items, true);
			foreach($manage as $data_item) {
				$temp = [];
				$temp['joborder_id'] = $id;
				$temp['item_id'] = $data_item['item_id'];
				$temp['units_id'] = $data_item['unit_id'];
				$temp['quantity'] = $data_item['quantity'];
				$temp['created_at'] = date('Y-m-d h:i:s');
				$temp['updated_at'] = date('Y-m-d h:i:s');
				$data_result[] = $temp;
			}

		return	MaterialCost::insert($data_result);
	}

}
