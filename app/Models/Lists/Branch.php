<?php 
namespace Nixzen\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {

	protected $table = 'branches';
	
	protected $primary_key = 'id';

	protected $fillable = ['name', 'description', 'user_id', 'inactive', 'created_by', 'updated_by'];

	public function location()
	{
		return $this->hasMany('Nixzen\Models\Lists\Location', 'location_id');
	}
	
	public function employee()
	{
		return $this->hasMany('Nixzen\Models\Lists\Employee', 'employee_id');
	}
	
	public function created_by()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'created_by');	
	}
	
	public function updated_by()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'updated_by');
	}

	public function company()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Company', 'company_id');
	}
}
