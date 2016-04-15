<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Taxcode extends Model {

	protected $table = 'taxcodes';

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}
}
