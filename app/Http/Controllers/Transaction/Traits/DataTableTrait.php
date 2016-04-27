<?php namespace Nixzen\Http\Controller\Traits;

trait DataTableTrait {

	public function anyData()
	{
		return Datatables::of($model)
				->addColumn('action', function($jobs) {
					return
					'<a href="purchaserequest/'.$jobs->id.'/edit">Edit |</a>
					<a href="purchaserequest/'.$jobs->id.'"">View</a>';
				})->make(true);
	}
}
