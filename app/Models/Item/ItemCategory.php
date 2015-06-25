<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model {

	protected $table = 'item_categories';
	
	protected $table = 'id';
	
	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
