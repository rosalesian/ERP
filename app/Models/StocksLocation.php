<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class StocksLocation extends Model {

	protected $table = 'stocks_locations';

	public function branch()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Branch', 'branch_id');
	}

	public function division()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Divisions', 'division_id');
	}

	public function createby()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'updated_by');
	}

}
