<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $table = 'lists';

		protected $fillable = [
			'name',
			'description'
		];

		public function items()
		{
			return $this->hasMany(ListItem::class, 'lists_id');
		}
}
