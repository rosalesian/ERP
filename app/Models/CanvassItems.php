<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class CanvassItems extends Model {

	protected $table = 'canvass_items';
	
	protected $primary_key = 'id';
	
	public function canvass(){
		return $this->belongsTo('Nixzen\Canvass', 'canvass_id');
	}
	
	public function unit(){
		return $this->belongsTo('Nixzen\Unit', 'unit_id');
	}
}
