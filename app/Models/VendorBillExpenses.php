<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBillExpenses extends Model
{
	protected $table = 'vendor_bill_expenses';

	protected $fillable = [
		'coa_id',
		'amount',
		'taxcode_id',
		'tax_amount',
		'gross_amount',
		'department_id',
		'division_id',
		'branch_id',
		'vendor_id'
	];

	public function vendorbill()
	{
		return $this->belongsTo('Nixzen\Models\VendorBill', 'vendorbill_id');
	}

	public function account()
	{
		//
	}

	public function taxcode()
	{
		return $this->belongsTo('Nixzen\Models\Taxcode', 'taxcode_id');
	}

	public function department()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Department', 'department_id');
	}
	//change divisions to division
	public function division()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Division', 'division_id');
	}

	public function branch()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Branch', 'branch_id');
	}

	public function vendor()
	{
		return $this->belongsTo('Nixzen\Models\Vendor', 'vendor_id');
	}

	//add relastionship for chart of account
	public function coa(){
		return $this->belongsTo('Nixzen\Models\ChartOfAccount', 'coa_id');
	}
    
}
