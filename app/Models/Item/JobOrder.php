<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model {

	protected $table = 'job_orders';
	
	protected $primary_key = 'id';
	
	protected $date = ['transdate'];
	
	public function asset(){
		return $this->belongsTo('Nixzen\Item', 'item_id');
	}
	
	public function branch(){
		return $this->belongsTo('Nixzen\Branch', 'branch_id');
	}

	public function approvalStatus(){
		return $this->belongsTo('Nixzen\ApprovalStatus', 'approvalstatus_id');
	}
	
	public function requestedBy(){
		return $this->belongsTo('Nixzen\Employee', 'requested_by');
	}
	
	public function maintenanceType(){
		return $this->belongsTo('Nixzen\Maintenance', 'maintenancetype_id');
	}
	
	public function purchaseRequestCategory(){
		return $this->belongsTo('Nixzen\PurchaseRequestCategory', 'prcategory_id');
	}
	
	public function division(){
		return $this->belongsTo('Nixzen\Division', 'division_id');
	}
	
	public function department(){
		return $this->belongsTo('Nixzen\Department', 'department_id');
	}
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
