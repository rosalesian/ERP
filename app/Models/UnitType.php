<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model {

	protected $table = 'unit_types';

	protected $fillable = ['name', 'description'];

	public function units()
	{
		return $this->hasMany('Nixzen\Models\Unit', 'unittype_id');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Models\Employee', 'updated_by');
	}
    //adding relationship Unit type for items
    public function items() {
        return $this->hasMany('Nixzen\Models\Item', 'unittype_id');
    }

}
