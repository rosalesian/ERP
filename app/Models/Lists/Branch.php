<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {

	protected $table = 'branches';
	
	protected $primary_key = 'id';
	
	public function location()
	{
		return $this->hasMany('Nixzen\Location', 'branch_id');
	}
	
	public function employee()
	{
		return $this->hasMany('Nixzen\Employee', 'branch_id');
	}
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
