<?php 
namespace Nixzen\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {

	protected $table = 'employees';
	
	protected $primary_key = 'id';

	protected $fillable = [
		'name', 
		'firstname', 
		'middlename', 
		'lastname', 
		'description', 
		'company_id',
		'branch_id',
		'department_id',
		'division_id',
		'inactive'
	];

	public function company(){
		return $this->belongsTo('Nixzen\Modles\List\Company', 'company_id');
	}
	
	public function branch(){
		return $this->belongsTo('Nixzen\Modles\List\Branch', 'branch_id');
	}
	
	public function department(){
		return $this->belongsTo('Nixzen\Modles\List\Department', 'department_id');
	}
	
	public function division(){
		return $this->belongsTo('Nixzen\Modles\List\Division', 'division_id');
	}	
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Modles\List\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Modles\List\Employee', 'updated_by');
	}

	public function getFullNameAttribute() {
	  return $this->firstname . ' ' . $this->middlename . ' ' . $this->lastname;
	}

}
