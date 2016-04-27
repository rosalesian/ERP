<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPaymentItem extends Model
{
    protected $table = 'vendor_payment_item';

	protected $fillable = [
		'apply',
		'bill_id'
	];

	public function bill()
	{
		return $this->belongsTo(VendorBill::class, 'bill_id');
	}
}
