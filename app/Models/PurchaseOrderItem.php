<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model {

	protected $table = 'purchase_order_items';

	protected $fillable = ['item_id', 'uom_id', 'quantity'];

	public function purchaseorder()
	{
		return $this->belongsTo('Nixzen\Models\PurchaseOrder', 'purchaseorder_id');
	}

	public function item()
	{
		return $this->belongsTo('Nixzen\Models\Item', 'item_id');
	}

	public function unit()
	{
		return $this->belongsTo('Nixzen\Models\Unit', 'unit_id');
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
