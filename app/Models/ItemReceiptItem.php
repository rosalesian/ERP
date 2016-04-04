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
		
		public function purchaseorderitem() {
			return $this->belongsTo('Nixzen\Models\PurchaseOrderItem','purchaseorderitem_id');
		}
		
		public function getAmount()
		{

		}

		public function getVatAmount()
		{

		}

		public function item()
		{
			return $this->belongsTo(Item::class, 'purchaseorderitem_id');
		}
}
