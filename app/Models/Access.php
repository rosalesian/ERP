<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Access extends Model {

	protected $table = 'accesses';
	
	protected $primary_key = 'id'
	
	public function access(){
		
		return $this->belongsTo('Nixzen\Roles', 'role_id');
	}
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
