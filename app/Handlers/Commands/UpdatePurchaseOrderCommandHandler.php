<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdatePurchaseOrderCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\PurchaseOrderRepository;
use Nixzen\Models\PurchaseOrderItem;
use Nixzen\Events\PurchaseOrderWasUpdated;

class UpdatePurchaseOrderCommandHandler
{
    public $purchaseorder
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(PurchaseOrderRepository $purchaseorder)
    {
        $this->purchaseorder    = $purchaseorder;
    }

    /**
     * Handle the command.
     *
     * @param  UpdatePurchaseOrderCommand  $command
     * @return void
     */
    public function handle(UpdatePurchaseOrderCommand $command)
    {
        $this->purchaseorder->create([
            'vendor'    => $command->vendor,
            'type'      => $command->type,
            'date'      => $command->date,
            'remarks'   => $command->remarks
        ]);

        $poItems = [];

        foreach($command->items as $item){
            array_push($poItems, new PurchaseOrderItem((array)$item));
        }
        $this->purchaseorder->items()->saveMany($poItems);

        event(new PurchaseOrderWasUpdated($purchaseorder));
    }
}