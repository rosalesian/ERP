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

	public function updateLineItems($inputs)
	{
		$ids = collect($inputs)->fetch('id')->toArray();
		$this->cleanLineItems($ids);

		foreach($inputs as $input)
		{
			$lineitem = $this->items()->firstOrNew(['id' => $input->id]);

			$lineitem->apply = $input->apply;
			$lineitem->bill_id = $input->bill_id;
			$lineitem->save();
		}
	}

	public function cleanLineItems($ids)
	{
		foreach($this->items as $key => $item)
		{
			if(in_array($item->id, $ids))
			{
				$item->delete();
			}
		}
	}
}
