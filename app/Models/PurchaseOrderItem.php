<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $table = 'purchase_order_items';

		protected $fillable = [
			'item_id',
			'quantity',
			'uom_id',
			'unit_cost'
		];
}
