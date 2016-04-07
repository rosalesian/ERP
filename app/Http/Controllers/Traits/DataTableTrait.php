<?php namespace Nixzen\Http\Controllers\Traits;

use Illuminate\Database\Eloquent\Model;
use Datatables;

trait DataTableTrait {

	public function anyData(Model $model)
	{
		$data = $model->index();

		return Datatables::of($data)
				->addColumn('action', function($data) {
					return
					'<a href="purchaserequest/'.$data->id.'/edit">Edit |</a>
					<a href="purchaserequest/'.$data->id.'"">View</a>';
				})->make(true);
	}
}
