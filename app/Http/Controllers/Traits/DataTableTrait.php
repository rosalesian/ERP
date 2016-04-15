<?php namespace Nixzen\Http\Controllers\Traits;

use Illuminate\Database\Eloquent\Model;
use Datatables;
use Nixzen\Models\PurchaseRequest;
use Route;

trait DataTableTrait {

	public function anyData()
	{
		$model = $this->getModel();
		$data = $model->index();
		$d = Datatables::of($data)
				->addColumn('action', function($data) {
					return
					'<a href='. "$this->root_uri/$data->id/edit" .'>Edit |</a>
					<a href='. "$this->root_uri/$data->id".'>View</a>';
				})->make(true);

		return $d;
	}
}
