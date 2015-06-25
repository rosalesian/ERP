<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model {

	protected $table = 'vendor_categories';

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
