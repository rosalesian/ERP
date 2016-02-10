<?php
namespace Nixzen\Services;

use Nixzen\Repositories\PurchaseRequestRepository;
use Nixzen\Repositories\PurchaseRequestItemRepository as Item;
use DB;
class PurchaseRequestService {

	public $puchaserequest;

	public $item;

	public function __construct(PurchaseRequestRepository $purchaserequest, Item $item){

		$this->purchaserequest = $purchaserequest;

		$this->item = $item;

	}

	public function create($request){
		//before submit
		
		//to be refactor
		return DB::transaction(function() use ($request){
			$input = $request->all();
			$purchaserequest = $this->purchaserequest->create($input);
			$items = [];

			$inputItems = json_decode($input['item']);
			if($inputItems != null){

				foreach($inputItems as $i => $item){
					array_push(
						$items, 
						$this->item->create($item)
					);
				}				
			}

			$purchaserequest->items()->saveMany($items);

			return $purchaserequest;
		});

		event(new Nixzen\Events\PurchaseRequestWasCreated($purchaserequest));
	}

	public function update($data, $id){
		//before submit		
		$purchaserequest;

		$purchaserequest = DB::transaction(function() use ($data)
		{

			$purchaserequest = $this->purchaserequest->update($data->all());
			$items = [];
			foreach($data['item'] as $i => $item){
				array_push(
					$items, 
					$this->item->update($data)
				);
			}

			$purchaserequest->items()->saveMany($items);

			return $purchaserequest;
		});

		return $purchaserequest;
		//after submit	
	}
}