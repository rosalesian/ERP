<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class ItemReceipt extends Model
{
    protected $table = 'itemreceipt';

		protected $fillable = [
				'date',
				'remarks',
				'created_by',
				'updated_by'
		];
}
