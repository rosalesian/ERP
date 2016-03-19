<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Canvass extends Model {

	protected $table = 'canvasses';

	protected $primary_key = 'id';

	protected $fillable = [
		'vendor_id',
		'terms_id',
		'cost',
		'purchaserequestitem_id',
		'approve',
	];

	public function vendor(){
		return $this->belongsTo('Nixzen\Vendor', 'vendor_id');
	}

	public function term(){
		return $this->belongsTo('Nixzen\Term', 'term_id');
	}

	public function canvassItems(){
		return $this->hasMany('Nixzen\CanvassItems', 'canvass_id');
	}

	public function created_by(){
		return $this->belongsTo('Nixzen\Employee', 'created_by');
	}

	public function updated_by(){
		return $this->belongsTo('Nixzen\Employee', 'updated_by');
	}

}
