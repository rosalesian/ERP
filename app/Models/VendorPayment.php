<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPayment extends Model
{
  	protected $table = 'vendor_payment';

		protected $fillable = [
			'transno',
			'coa_id',
			'payee_id',
			'date',
			'posting_period_id',
			'checkno',
			'checkdate',
			'principal_id',
			'branch_id'
		];

		public function items()
		{
			return $this->hasMany(VendorPaymentItem::class, 'vendor_payment_id');
		}
}
