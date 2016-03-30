<?php namespace Nixzen\Services;

use Nixzen\Repositories\InventoryRepository;
use Nixzen\Models\ItemReceiptItems;
class InventoryService {

		protected $inventory;

		public function __construct(InventoryRepository $inventory)
		{
				$this->inventory = $inventory;
		}

		public function in($company_id, $item_id, $branch_id, $lot_id, $bin_id, $qty)
		{
				$inv = $this->inventory->findBy('item_id', 1);

				if($inv != null){
					return $inv->update([
						'company_id' => $company_id,
						'item_id' => $item_id,
						'branch_id' => $branch_id,
						'lot_id' => $lot_id,
						'bin_id' => $bin_id,
						'quantity' => $qty
					]);
				}else{
					return $this->inventory->create([
						'company_id' => $company_id,
						'item_id' => $item_id,
						'branch_id' => $branch_id,
						'lot_id' => $lot_id,
						'bin_id' => $bin_id,
						'quantity' => $qty
					]);
				}

		}

		public function out($ffItems, $qty){

		}

		public function adjust(){

		}

		private function hasItem($item){
			return $this->inventory->findBy('item_id', $item);
		}
}
