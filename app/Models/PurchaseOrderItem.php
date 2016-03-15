<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model {

	protected $table = 'purchase_order_items';

	protected $fillable = ['item_id', 'uom_id', 'quantity'];

	public function purchaseorder()
	{
		return $this->belongsTo('Nixzen\PurchaseOrder', 'purchaseorder_id');
	}

	public function item()
	{
		return $this->belongsTo('Nixzen\Item', 'name');
	}

	public function unit()
	{
		return $this->belongsTo('Nixzen\Unit', 'unit_id');
	}

	public function taxcode()
	{
		return $this->belongsTo('Nixzen\Taxcode', 'taxcode');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
