<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class JobOrderType extends Model {

	protected $table = 'job_order_types';
	
	protected $primary_key = 'id';
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
