<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model {

	protected $table = 'purchase_orders';

	protected $fillable =
	[
		'vendor_id',
		'terms_id',
		'date',
		'type_id',
		'paymenttype_id',
		'memo'
	];

	public function vendor()
	{
		return $this->belongsTo('Nixzen\Models\Vendor', 'vendor_id');
	}

	public function purchaserequestcategory()
	{
		return $this->belongsTo('Nixzen\PurchaseRequestCategory',
								'purchaserequestcategory_id');
	}

	public function paymenttype()
	{
		return $this->belongsTo(PaymentType::class, 'paymenttype_id');
	}

	public function term()
	{
		return $this->belongsTo('Nixzen\Models\Terms', 'terms_id');
	}

	public function approvalstatus()
	{
		return $this->belongsTo('Nixzen\Models\ApprovalStatus', 'approvalstatus_id');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'created_by');
	}

	public function purchaserequisition()
	{
		return $this->belongsTo('Nixzen\Models\PurchaseRequest', 'purchaserequisition');
	}

	public function department()
	{
		return $this->belongsTo('Nixzen\Models\Department', 'department_id');
	}

	public function division()
	{
		return $this->belongsTo('Nixzen\Models\Divisions', 'division_id');
	}

	public function requestedby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'requested_by');
	}

	public function stockloction()
	{
		return $this->belongsTo('Nixzen\Models\StocksLocation', 'stocklocation_id');
	}

	public function items()
	{
		return $this->hasMany('Nixzen\Models\PurchaseOrderItem', 'purchaseorder_id');
	}

	public function itemreceipt()
	{
		return $this->hasMany(ItemReceipt::class, 'purchaseorder_id');
	}

	public function getAmountDue()
	{
		$amountDue = 0;
		$lineitems = $this->items()->get();

		foreach($lineitems as $lineitem)
		{
			$amountDue += $lineitem->amount();
		}

		return $amountDue;
	}

	public function getTotalVatAmount()
	{
		$totalVatAmount = 0;
		$lineitems = $this->items()->get();

		foreach($lineitems as $lineitem)
		{
			$totalVatAmount += $lineitem->vatAmount();
		}

		return $totalVatAmount;
	}
}
