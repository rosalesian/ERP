<?php 
namespace Nixzen\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	protected $table = 'companies';
	
	protected $primary_key = 'id';

	protected $fillable = ['name', 'description', 'tin', 'inactive', 'created_by', 'updated_by'];

	public function branches()
	{
		return $this->hasMany('Nixzen\Modles\List\Company', 'company_id');
	}
	
	public function items()
	{
		return $this->hasMany('Nixzen\Modles\List\Item', 'item_id');
	}

	public function vendors()
	{
		return $this->hasMany('Nixzen\Modles\List\Vendor', 'vendor_id');
	}

	public function employees()
	{
		return $this->hasMany('Nixzen\Modles\List\Employee', 'employee_id');
	}

	public function departments()
	{
		return $this->hasMany('Nixzen\Modles\List\Department', 'department_id');
	}
}
