<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model {

	protected $table = 'vendors';

	protected $fillable = [
		'name',
		'description',
		'email',
		'phone',
		'faxno',
		'contact_person',
		'auto_apply_wtax',
		'vendorcategories_id',
		'tin',
		'branch_id',
		'taxcode_id',
		'term_id',
		'inactive',
		'created_by',
		'updated_by'
	];

	public function vendorcategory()
	{
		return $this->belongsTo('Nixzen\VendorCategory', 'vendorcategories_id');
	}

	public function branch()
	{
		return $this->belongsTo('Nixzen\Branch', 'branch_id');
	}

	public function taxcode()
	{
		return $this->belongsTo('Nixzen\Taxcode', 'taxcode_id');
	}

	public function term()
	{
		return $this->belongsTo('Nixzen\Terms', 'term_id');
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
