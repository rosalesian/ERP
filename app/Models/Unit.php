<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

	protected $table = 'units';

	protected $fillable = [
		'name',
		'pluralname',
		'abbreviation',
		'plural_abbreviation',
		'conversion_rate',
		'base_unit'
	];

	// public function unittype()
	// {
	// 	return $this->belongsTo('Nixzen\UnitType', 'unittype_id');
	// }

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

	public function materialCost() {
		return $this->hasMany('Nixzen\Models\Unit', 'units_id');
	}

}
