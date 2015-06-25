<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model {

	protected $table = 'expense_categories';
	
	protected $primary_key = 'id';

	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
