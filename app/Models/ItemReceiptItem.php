<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class ItemReceiptItem extends Model
{
    protected $table = 'itemreceipt_item';

		protected $fillable = [
			'purchaseorderitem_id',
			'quantity_received'
		];

		public function getAmount()
		{

		}

		public function getVatAmount()
		{

		}

		public function item()
		{
			return $this->belongsTo(Nixzen\Models\Item::class, 'item_id');
		}
}
