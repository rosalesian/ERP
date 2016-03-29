<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    protected $table = 'list_item';

		protected $fillable = [
			'name',
			'inactive'
		];
}
