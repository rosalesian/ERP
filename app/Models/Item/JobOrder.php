<?php namespace Nixzen\Models\Item;

use Illuminate\Database\Eloquent\Model;
use Datatables;
use DB;
use Nixzen\Models\LaborItem;

class JobOrder extends Model {

	protected $fillable = [
			'transdate',
			'transnumber',
			'asset_id',
			'requested_by',
			'maintenancetype_id',
			'prcategory_id',
			'memo',
			'purchaserequest_id'
		];
	protected $table = 'job_orders';
	
	protected $primary_key = 'id';
	
	protected $date = ['transdate'];
	
	public function asset(){
		return $this->belongsTo('Nixzen\Models\Item', 'item_id');
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

	public function items(){
		return $this->belongsTo('Nixzen\Models\Item', 'asset');
	}
    //add relationship joborder to material costs
	public function materialCost() {
		return $this->hasMany('Nixzen\Models\MaterialCost', 'joborder_id');
	}
    //add relationship joborder to labor costs
    public function laborItems() {
        return $this->hasMany('Nixzen\Models\LaborItem', 'joborder_id');
    }
    //add relationship joborder to purchase requests
    public function purchseRequests() {
    	return $this->belongsTo('Nixzen\Models\PurchaseRequest', 'purchaserequest_id');
    }


	public static function getIndex() {

        $jobs = JobOrder::select('job_orders')
        				->leftjoin('assets', 'job_orders.asset_id', '=', 'assets.id')
        				->leftjoin('departments', 'job_orders.id', '=', 'departments.id')
        				->leftjoin('employees', 'job_orders.requested_by', '=', 'employees.id')
        				->leftjoin('maintenance_types', 'job_orders.maintenancetype_id', '=', 'maintenance_types.id')
        				->leftjoin('purchase_request_categories', 'job_orders.prcategory_id', '=', 'purchase_request_categories.id')
        				->select(
	        					'job_orders.id', 
	        					'job_orders.transdate', 
	        					'assets.name as asset_name',
	        					'job_orders.memo',
	        					'departments.name as dept_name', 
	        					DB::raw('CONCAT(employees.firstname, " ", employees.middlename, " ", employees.lastname) AS full_name'),
	        					'maintenance_types.description as maintenance_description',
	        					'purchase_request_categories.description as prc_description',
	        					'job_orders.created_at',
	        					'job_orders.updated_at'
        					)->get();

        return Datatables::of($jobs)
        					 ->addColumn('action', function ($jobs) {
					                return 
					                '<a href="joborder/'.$jobs->id.'/edit">Edit |</a>
					                <a href="joborder/'.$jobs->id.'"">View</a>';
					            })
        					->editColumn('created_at', '{!! $created_at->diffForHumans() !!}')
        					->make(true);
	}

	public static function addJObOrder($data) {

		DB::beginTransaction();

		$joborder = JobOrder::create($data);
		if($joborder != null && $joborder != '' ) {
			$data_labor_costs = $data['labor_costs'];
			$value_labor = LaborItem::addLaborItem($data_labor_costs, $joborder->id);

		}
		else {
			DB::rollback();
		}

		DB::commit();

		return $joborder->id;

	}
}
