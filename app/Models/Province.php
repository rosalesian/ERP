<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model {

	protected $table = 'provinces';

	protected $fillable = ['name', 'description'];

}
