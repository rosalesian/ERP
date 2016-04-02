<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'items';

	protected $primary_key = 'id';

	protected $fillable = [
		'name',
		'itemcode',
		'unittype_id',
		'itemtype_id',
		'default_purchaseunit_id',
		'default_salesunit_id',
		'default_stockunit_id',
		'account_id',
		'itemcategory_id',
		'expensecategory_id',
		'taxcode_id'
	];
	public function unitType(){
		return $this->belongsTo('Nixzen\Models\UnitType', 'unittype_id');
	}

	public function itemType(){
		return $this->belongsTo('Nixzen\Models\Item\ItemTypes', 'itemtype_id');
	}

	public function itemCategory(){
		return $this->belongsTo('Nixzen\Models\Item\ItemCategory', 'itemcategory_id');
	}

	public function taxcode(){
		return $this->belongsTo('Nixzen\Models\Taxcode', 'taxcode_id');
	}

	public function expenseCategory(){
		return $this->belongsTo('Nixzen\Models\ExpenseCategory', 'expensecategory_id');
	}

	public function created_by(){
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'created_by');
	}

	public function updated_by(){
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'updated_by');
	}

	public function branch(){
		return $this->belongsTo('Nixzen\Models\Lists\Branch', 'branch_id');
	}

	public function joborder() {
		return $this->hasMany('Nixzen\Models\Item\JobOrder', 'item_id');
	}
    //adding relationship material cost for item
	public function materialCost() {
		return $this->hasMany('Nixzen\Models\MaterialCost', 'item_id');
	}
	//adding relationship labor item for item
	public function laborItem() {
		return $this->hasMany('Nixzen\Models\laborItem', 'item_id');
	}
}
