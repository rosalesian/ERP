<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $table = 'roles';

	public function user()
	{
		return $this->belongsTo('Nixzen\User', 'user_id');	
	}
	
	public function access()
	{
		return $this->hasMany('Nixzen\Access', 'role_id');
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
