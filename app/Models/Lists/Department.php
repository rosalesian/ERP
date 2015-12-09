<?php 
namespace Nixzen\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

	protected $table = 'departments';
	
	protected $primary_key = 'id';

	protected $fillable = ['name', 'company_id', 'description', 'code', 'inactive'];

	public function created_by()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'created_by');	
	}
	
	public function updated_by()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'updated_by');
	}

	public function company()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Company', 'company_id');
	}
}
