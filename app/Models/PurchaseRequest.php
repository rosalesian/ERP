<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model {

	protected $table = 'purchase_requests';	

	public function purchaserequestcategory()
	{
		return $this->belongsTo('Nixzen\PurchaseRequestCategory',
								'purchaserequestcategory_id');
	}

	public function role()
	{
		return $this->belongsTo('Nixzen\Role', 'nextapprover_role');
	}

	public function division()
	{
		return $this->belongsTo('Nixzen\Divisions', 'division_id');
	}

	public function department()
	{
		return $this->belongsTo('Nixzen\Department', 'department_id');
	}

	public function joborder()
	{
		return $this->belongsTo('Nixzen\JobOrder', 'joborder_id');
	}

	public function requestedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'requested_by');
	}

	public function approvalstatus()
	{
		return $this->belongsTo('Nixzen\ApprovalStatus', 'approvalstatus_id');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

	public function recordType(){
		return $this->belongsTo('Nixzen\RecordType', 'recordtype_id');
	}

	public function activeWorkflow(){
		
		return $this->hasMany('Nixzen\ActiveWorkflow', 'record_id')
					->where('recordtype_id', $this->recordtype);
	}
}
