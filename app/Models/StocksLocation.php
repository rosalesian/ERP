<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class StocksLocation extends Model {

	protected $table = 'stocks_locations';

	public function branch()
	{
		return $this->belongsTo('Nixzen\Branch', 'branch_id');
	}

	public function division()
	{
		return $this->belongsTo('Nixzen\Divisions', 'division_id');
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
