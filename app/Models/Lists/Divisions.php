<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Divisions extends Model {

	protected $table = 'divisions';
	
	protected $primary_key = 'id';
	
	public function branch(){
		return $this->belongsTo('Nixzen\Branch', 'branch_id');
	}
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
