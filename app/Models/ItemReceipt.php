<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class ItemReceipt extends Model
{
  protected $table = 'itemreceipt';

	protected $fillable = [
		'purchaseorder_id',
		'date',
		'remarks',
		'created_by',
		'updated_by'
	];

	public function items()
	{
		return $this->hasMany(ItemReceiptItem::class, 'itemreceipt_id');
	}

	public function createBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function updateLineItems($inputs)
	{
		$ids = collect($inputs)->fetch('id')->toArray();
		$this->cleanLineItem($ids);

		foreach($inputs as $input)
		{
			$lineitem = $this->items()->firstOrNew(['id' => $input->id]);

			$lineitem->purchaseorderitem_id = $input->purchaseorderitem_id;
			$lineitem->quantity_received = $input->quantity_received;
		}
	}

	public function cleanLineItem($ids)
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
