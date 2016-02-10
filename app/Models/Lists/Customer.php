<?php 
namespace Nixzen\Models\Lists;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

	protected $table = 'company';
	
	protected $primary_key = 'id';

	protected $fillable = [
		'name', 
		'company_id', 
		'description', 
		'code', 
		'inactive'
	];

	public function branch()
	{
		return $this->belongsTo('Nixzen\Modles\List\Branch', 'branch_id');
	}
	
	public function company()
	{
		return $this->belongsTo('Nixzen\Modles\List\Company', 'company_id');	
	}

}
