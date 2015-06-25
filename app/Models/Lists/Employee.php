<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	protected $table = 'employees';
	
	protected $primary_key = 'id';
	
	public function branch(){
		return $this->belongsTo('Nixzen\Branch', 'branch_id');
	}
	
	public function department(){
		return $this->belongsTo('Nixzen\Department', 'department_id');
	}
	
	public function division(){
		return $this->belongsTo('Nixzen\Division', 'division_id');
	}	
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
