<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model {

	protected $table = 'expense_categories';
	
	protected $primary_key = 'id';

	public function created_by(){
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'created_by');	
	}
	
	public function updated_by(){
		return $this->belongsTo('Nixzen\Models\ListsEmployee', 'updated_by');
	}
}
