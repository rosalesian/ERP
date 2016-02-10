<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreatePurchaseOrderCommand;
use Nixzen\Repositories\PurchaseOrderRepository;
use Nixzen\Models\PurchaseOrderItem;
use Illuminate\Queue\InteractsWithQueue;

class CreatePurchaseOrderCommandHandler
{
    public $purchaseorder;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(PurchaseOrderRepository $purchaseorder)
    {
        $this->purchaseorder = $purchaseorder;
    }

    /**
     * Handle the command.
     *
     * @param  CreatePurchaseOrderCommand  $command
     * @return void
     */
    public function handle(CreatePurchaseOrderCommand $command)
    {
        $purchaseorder = $this->purchaseorder->create([
            'vendor'    => $command->vendor,
            'date'      => $command->date,
            'type'      => $command->type,
            'remarks'   => $command->remarks
        ]);

        $poItems = [];
        foreach($command->items as $item){
            array_push($poItems, new PurchaseOrderItem((array)$item));
        }

        $purchaseorder->items()->saveMany($poItems);

        event(new PurchaseOrderWasCreate($purchaseorder));

        return $purchaseorder;
    }
}
