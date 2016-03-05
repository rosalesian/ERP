<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateItemReceiptCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\ItemReceiptRepository;
use Nixzen\Repositories\PurchasOrderRepository;
use Nixzen\Repositories\PurchasOrderItemRepository;
use Nixzen\Repositories\ItemReceiptItemRepository;

class CreateItemReceiptCommandHandler
{
    public $itemreceipt;

    public $purchaseorder;

    public $poItem;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(
        ItemReceiptRepository $itemreceipt,
				ItemReceiptItemRepository $irItem,
        PurchasOrderRepository $purchaseorder,
        PurchaseOrderItemRepository $poItem
        )
    {
        $this->itemreceipt		= $itemreceipt;
				$this->irItem			= $irItem;
        $this->purchaseorder  	= $purchaseorder;
        $this->poItem         	= $poItem;
    }

    /**
     * Handle the command.
     *
     * @param  CreateItemReceiptCommand  $command
     * @return void
     */
    public function handle(CreateItemReceiptCommand $command)
    {
        $itemreceipt = $this->itemreceipt->create([
            'purchaseorder_id'	=> $command->purchaseorder,
            'date'           	=> $command->date,
            'remarks'        	=> $command->remarks
        ]);

        $irItems = [];
        foreach($command->items as $item){

					$irItem = $this->irItem->create([
						'purchaseorderitem_id'	=> $item->purchaseorderitem_id,
						'quantity_received'	=> $item->quantity_received,
					]);

		      array_push($irItems, $irItem);
	      }

				$itemreceipt->saveMany($irItems);

		return $itemreceipt;
    }
}
