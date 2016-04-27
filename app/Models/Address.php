<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	protected $table = 'addresses';
	
	protected $primary_key = 'id';
	
	public function province(){
		return $this->hasOne('Nixzen\Province', 'province_id');
	}
	
	public function vendor(){
		return $this->belongsTo('Nixzen\Vendor', 'vendor_id');
	}
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}	

}
