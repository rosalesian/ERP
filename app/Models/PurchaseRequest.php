<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class PurchaseRequest extends Model {

	protected $table = 'purchase_requests';

	protected $fillable = [
		'requester',
		'type_id',
		'date',
		'joborder_id',
		'deliver_to',
		'division_id',
		'remarks',
		'purchaserequestcategory_id',
		'approvalstatus_id',
		'total_amount'
	];

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
		return $this->belongsTo('Nixzen\Models\Lists\Division', 'division_id');
	}

	public function department()
	{
		return $this->belongsTo('Nixzen\Models\Department', 'department_id');
	}

	public function joborder()
	{
		return $this->belongsTo('Nixzen\Models\JobOrder', 'joborder_id');
	}

	public function requestedby()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'requested_by');
	}

	public function approval()
	{
		return $this->belongsTo('Nixzen\Models\ApprovalStatus', 'approvalstatus_id');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'updated_by');
	}

	public function recordType(){
		return $this->belongsTo('Nixzen\Models\RecordType', 'recordtype_id');
	}

	public function items(){
		return $this->hasMany('Nixzen\Models\PurchaseRequestItem', 'purchaserequisition_id');
	}

	public function workflows(){

		return $this->hasMany('Nixzen\Models\Workflow', 'record_id');
	}

	public function updateLineItems($inputs){
		foreach($inputs as $input)
		{
			$lineitem = $this->items()
					->firstOrNew(['id' => $input->id]);

			$lineitem->item_id = $input->item_id;
			$lineitem->quantity = $input->quantity;
			$lineitem->unit_id = $input->unit_id;
			$lineitem->save();
		}

		$ids = collect($inputs)->fetch('id')->toArray();
		$this->cleanLineItems($ids);
	}

	public function cleanLineItems($ids)
	{
		foreach($this->items as $key => $item)
		{
			if(in_array($item->id, $ids))
			{
				$item->delete();
			}
		}
	}

	public function index()
	{
		return DB::table('purchase_requests')
				   ->leftjoin(
				   	'item_types', 'purchase_requests.type_id', '=', 'item_types.id')
				   ->leftjoin('departments', 'purchase_requests.type_id', '=', 'departments.id')
				   ->select(
						   'purchase_requests.id',
						   'purchase_requests.deliver_to',
						   'purchase_requests.created_at',
						   'purchase_requests.total_amount',
						   'purchase_requests.remarks',
						   'purchase_requests.date',
						   'item_types.name',
						   'departments.name as dep_name',
						   'departments.description'
					   );
	}
}
