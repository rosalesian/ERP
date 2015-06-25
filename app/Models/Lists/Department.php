<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	protected $table = 'departments';
	
	protected $primary_key = 'id';

	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
