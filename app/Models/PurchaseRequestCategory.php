<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestCategory extends Model {

	protected $table = 'purchase_request_categories';

	protected $fillable = [
			'name',
			'description',
			'inactive',
			'created_by',
			'updated_by'
		];

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
