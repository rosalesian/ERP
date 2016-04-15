<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model {

	protected $table = 'terms';

	public function createby()
	{
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updatedby()
	{
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
