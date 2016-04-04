<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBill extends Model
{
    protected $table = 'vendor_bills';

    protected $fillable = [
    	'vendor_id',
    	'transno', 
		'suppliers_inv_no', 
		'date', 
		'duedate', 
		'billtype_id', 
		'billtype_nontrade_subtype_id',
		'coa_id',
		'terms_id',
		'posting_period_id',
		'department_id',
		'division_id',
		'branch_id',
		'memo'
    ];

    /*public function items()
    {
    	return $this->belongsTo('Nixzen\Models\VendorBillItem', 'billtype_id');
    }*/

    public function items()
    {
    	return $this->hasMany('Nixzen\Models\VendorBillItem', 'vendorbill_id');
    }

    /*public function vendorBillItems()
    {
        return $this->hasMany('Nixzen\Models\VendorBillItem', 'vendorbill_id');
    }

    public function billitems()
    {
        return $this->belongsTo('Nixzen\Models\VendorBillItem', 'billtype_id');
    }*/


    public function expenses()
    {
    	return $this->hasMany('Nixzen\Models\VendorBillExpenses', 'vendorbill_id');
    }

    public function vendor()
	{
		return $this->belongsTo('Nixzen\Models\Vendor', 'vendor_id');
	}

	public function billtype()
	{
		return $this->belongsTo('Nixzen\Models\BillType', 'billtype_id');
	}

	public function billtypenontradesubtype()
	{
		return $this->belongsTo('Nixzen\Models\BillTypeNonTradeSubType', 'billtype_nontrade_subtype_id');
	}

	public function term()
	{
		return $this->belongsTo('Nixzen\Models\Terms', 'terms_id');
	}

	public function department()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Department', 'department_id');
	}

	public function division()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Division', 'division_id');
	}

	public function branch()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Branch', 'branch_id');
	}

	public function approvalstatus()
	{
		return $this->belongsTo('Nixzen\Models\ApprovalStatus', 'approvalstatus_id');
	}

	public function getcreateby()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'created_by');
	}

	public function getupdatedby()
	{
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'updated_by');
	}

	public function removeitems($ids)
    {
        foreach ($this->items as $key => $item) {

             if(!in_array($item->id,$ids))
             {
                $item->delete();
             }
        }
    }

    public function removeexpenses($ids)
    {
        foreach ($this->expenses as $key => $expense) {

             if(!in_array($expense->id,$ids))
             {
                $expense->delete();
             }
        }
    }
}
