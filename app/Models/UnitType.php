<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model {

	protected $table = 'unit_types';

	protected $fillable = ['name', 'description'];

	public function units()
	{
		return $this->hasMany('Nixzen\Unit', 'unittype_id');
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
