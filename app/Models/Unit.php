<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

	protected $table = 'units';

	public function unittype()
	{
		return $this->belongsTo('Nixzen\UnitType', 'unittype_id');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
