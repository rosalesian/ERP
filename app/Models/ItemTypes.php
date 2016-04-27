<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTypes extends Model {

	protected $table = 'item_types';

	protected $primary_key = 'id';

	protected $fillable = ['name', 'description'];

	public function created_by(){
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'created_by');
	}

	public function updated_by(){
		return $this->belongsTo('Nixzen\Models\Lists\Employee', 'updated_by');
	}

	public function itemType()
	{
		return $this->hasMany('Nixzen\Models\Item\Item', 'type_id');
	}
}
