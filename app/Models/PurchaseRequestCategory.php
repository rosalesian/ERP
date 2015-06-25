<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestCategory extends Model {

	protected $table = 'purchase_request_categories';

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
