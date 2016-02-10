<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model {

	protected $table = 'maintenance_types';
	
	protected $primary_key = 'id';

	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
