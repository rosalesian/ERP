<?php namespace Nixzen\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model {

	protected $table = 'purchase_orders';

	public function purchaseorderitems()
	{
		return $this->hasMany('Nixzen\PurchaseOrderItem', 'purchaseorder_id');
	}

	public function vendor()
	{
		return $this->belongsTo('Nixzen\Vendor', 'name');
	}

	public function purchaserequestcategory()
	{
		return $this->belongsTo('Nixzen\PurchaseRequestCategory',
								'purchaserequestcategory_id');
	}

	public function paymenttype()
	{
		return $this->belongsTo('Nixzen\PaymentType', 'paymenttype_id');
	}

	public function term()
	{
		return $this->belongsTo('Nixzen\Terms', 'terms_id');
	}

	public function approvalstatus()
	{
		return $this->belongsTo('Nixzen\ApprovalStatus', 'approvalstatus_id');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function purchaserequisition()
	{
		return $this->belongsTo('Nixzen\PurchaseRequest', 'purchaserequisition');
	}

	public function department()
	{
		return $this->belongsTo('Nixzen\Department', 'department_id');
	}

	public function division()
	{
		return $this->belongsTo('Nixzen\Divisions', 'division_id');
	}

	public function requestedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'requested_by');
	}

	public function stockloction()
	{
		return $this->belongsTo('Nixzen\StocksLocation', 'stocklocation_id');
	}
}
