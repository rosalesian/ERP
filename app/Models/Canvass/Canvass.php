<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Canvass extends Model {

	protected $table = 'canvassess';
	
	protected $primary_key = 'id';
	
	public function vendor(){
		return $this->belongsTo('Nixzen\Vendor', 'vendor_id');
	}
	
	public function term(){
		return $this->belongsTo('Nixzen\Term', 'term_id');
	}
	
	public function canvassItems(){
		return $this->hasMany('Nixzen\CanvassItems', 'canvass_id');
	}
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
