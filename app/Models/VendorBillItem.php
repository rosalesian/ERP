<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBillItem extends Model
{
    protected $table = 'vendor_bill_items';

    protected $fillable = [
    	'item_id',
		'quantity',
		'uom_id',
		'unit_cost',
		'amount',
		'taxcode_id',
		'tax_amount',
		'gross_amount',
        'vendorbill_id'
    ];

    //change belongsTo to hasMany
    public function vendorbill()
	{
		return $this->hasMany('Nixzen\Models\VendorBill', 'vendorbill_id');
	}

    public function item()
	{
		return $this->belongsTo('Nixzen\Models\Item', 'item_id');
	}

	public function unit()
	{
		return $this->belongsTo('Nixzen\Models\Unit', 'uom_id');
	}

	public function taxcode()
	{
		return $this->belongsTo('Nixzen\Models\Taxcode', 'taxcode_id');
	}
}
