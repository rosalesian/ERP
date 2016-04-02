<?php namespace Nixzen\Models\Item;

use Illuminate\Database\Eloquent\Model;
use Datatables;
use DB;

class JobOrder extends Model {

	protected $fillable = [
			'transdate',
			'transnumber',
			'asset',
			'requested_by',
			'maintenancetype_id',
			'prcategory_id',
			'memo'
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

	//last event
	/*//need to modified
	static function materialCost($id) {
		return DB::table('job_orders')
					->leftjoin('material_costs', 'job_orders.id', '=', 'material_costs.id')
					->leftjoin('items', 'material_costs.item_id', '=', 'items.id')
					->leftjoin('units', 'material_costs.units_id', '=', 'units.id')
					->select(
						'job_orders.id', 
						'units.name', 
						'units.pluralname', 
						'units.abbreviation', 
						'items.description'
					)
					->where('material_costs.joborder_id', '=', $id)
					->get();
	}*/

	public static function getIndex() {

        $jobs = DB::table('job_orders')
        				->leftjoin('items', 'job_orders.asset', '=', 'items.id')
        				->leftjoin('departments', 'job_orders.id', '=', 'departments.id')
        				->leftjoin('employees', 'job_orders.requested_by', '=', 'employees.id')
        				->leftjoin('maintenance_types', 'job_orders.maintenancetype_id', '=', 'maintenance_types.id')
        				->leftjoin('purchase_request_categories', 'job_orders.prcategory_id', '=', 'purchase_request_categories.id')
        				->select(
	        					'job_orders.id', 
	        					'job_orders.transdate', 
	        					'items.description as item_description',
	        					'job_orders.memo',
	        					'departments.name as dept_name', 
	        					'employees.firstname',
	        					'maintenance_types.description as maintenance_description',
	        					'purchase_request_categories.description as prc_description',
	        					'job_orders.created_at',
	        					'job_orders.updated_at'
        					)
        				  ->orderBy('job_orders.created_at', 'desc');

        return Datatables::of($jobs)
        					 ->addColumn('action', function ($jobs) {
					                return 
					                '<a href="#edit-'.$jobs->id.'"">Edit |</a>
					                <a href="joborder/'.$jobs->id.'"">View</a>';
					            })
        					->make(true);
	}
}
