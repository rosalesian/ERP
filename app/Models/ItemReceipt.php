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
}
