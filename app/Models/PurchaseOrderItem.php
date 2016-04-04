<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model {

	protected $table = 'purchase_order_items';

	const VAT_RATE = 0.12;

	protected $fillable =
	[
		'item_id',
		'uom_id',
		'quantity',
		'unit_cost'
	];

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

	public function getGrossAmount()
	{
		return $this->getAmount() * (self::VAT_RATE + 1);
	}

	public function getVatAmount()
	{
		return $this->getAmount() * self::VAT_RATE;
	}

	public function getAmount()
	{
		return $this->quantity * $this->unit_cost;
	}
}
