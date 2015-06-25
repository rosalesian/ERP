<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {
	
	protected $table = 'items';
	
	protected $primary_key = 'id';
	
	public function unitType(){
		return $this->belongsTo('Nixzen\UnitType', 'unittype_id');
	}
	
	public function itemType(){
		return $this->belongsTo('Nixzen\ItemTypes', 'itemtype_id');
	}
	
	public function itemCategory(){
		return $this->belongsTo('Nixzen\ItemCategory', 'itemcategory_id');
	}
	
	public function taxcode(){
		return $this->belongsTo('Nixzen\Taxcode', 'taxcode_id');
	}
	
	public function expenseCategory(){
		return $this->belongsTo('Nixzen\ExpenseCategory', 'expensecategory_id');
	}

	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
