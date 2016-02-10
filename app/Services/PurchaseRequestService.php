<?php
namespace Nixzen\Services;

use Nixzen\Repositories\PurchaseRequestRepository;
use Nixzen\Repositories\PurchaseRequestItemRepository;
use DB;
class PurchaseRequestService {

	protected $puchaserequest;

	protected $items;
	public function __construct(PurchaseRequest $purchaserequest, PurchaseRequestItems $items) {

		$this->purchaserequest = $purchaserequest;

		$this->items = $items;	

	}

	public function create($data){
		//before submit
		DB::transaction(function(){

			$this->purchaserequest->create($data);

			if ($data->has('items')){

				$this->purchaserequest->items->create($data->input('items'));

			}
		});
		//after submit	
	}

	public function update($data, $id){
		//before submit
		DB::transaction(function(){

			$this->purchaserequest->update($data, $id);

			if ($data->has('items')){

				$this->purchaserequest->items->update($data->input('items'), $id);

			}
		});
		//after submit			
	}
}