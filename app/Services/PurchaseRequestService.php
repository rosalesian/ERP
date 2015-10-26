<?php
namespace Nixzen\Services\;

use Nixzen\Repositories\PurchaseRequestRepository;
use Nixzen\Repositories\PurchaseRequestItemRepository;
use DB;
class PurchaseRequestService {

	protected $puchaserequest;

	protected $items
	public function __construct(PurchaseRequest $purchaserequest, PurchaseRequestItems $items){
		$this->purchaserequest = $purchaserequest;
		$this->items = $items;
	}

	public function create($data){
		//before submit
		DB::transaction(function(){

			$this->purchaserequest->create($data);

			if ($data->has('items')){
				$this->purchaserequest->items->create();
			}
		})
		//after submit	
	}
}