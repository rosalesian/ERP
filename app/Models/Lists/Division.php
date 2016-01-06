<?php 
namespace Nixzen\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class Division extends Model {

	protected $table = 'divisions';
	
	protected $primary_key = 'id';

	protected $fillable = ['name', 'description'];
	
	public function branch()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Branch', 'branch_id');
	}
	
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
