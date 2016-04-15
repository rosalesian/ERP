<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model {

	protected $table = 'purchase_request_items';

	protected $fillable = [
		'item_id',
		'quantity',
		'unit_id',
		'unit_cost',
		'amount',
		'taxcode',
		'taxrate',
		'gross_amount',
	];

	public function canvasses()
	{
		return $this->hasMany('Nixzen\Models\Canvass', 'purchaserequestitem_id');
	}

	public function purchaserequisition()
	{
		return $this->belongsTo('Nixzen\PurchaseRequest', 'purchaserequisition_id');
	}

	public function item()
	{
		return $this->belongsTo('Nixzen\Models\Item', 'item_id');
	}

	public function unit()
	{
		return $this->belongsTo('Nixzen\Models\Unit', 'unit_id');
	}

	public function vendor()
	{
		return $this->belongsTo('Nixzen\Models\Vendor', 'vendor_id');
	}

	public function term()
	{
		return $this->belongsTo('Nixzen\Models\Terms', 'term_id');
	}

	public function taxcode()
	{
		return $this->belongsTo('Nixzen\Models\Taxcode', 'taxcode');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'updated_by');
	}

}
