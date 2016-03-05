<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreatePurchaseOrderCommand;
use Nixzen\Repositories\PurchaseOrderRepository;
use Nixzen\Models\PurchaseOrderItem;
use Nixzen\Events\PurchaseOrderWasCreated;
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
            'vendor_id'        => $command->vendor,
            'terms_id'         => $command->terms,
            'date'          => $command->date,
            'type_id'          => $command->type,
            'paymenttype_id'   =>$command->paymentType,
            'memo'       => $command->remarks
        ]);

        $poItems = [];
        foreach($command->items as $item){
            array_push($poItems, new PurchaseOrderItem((array)$item));
        }

        $purchaseorder->items()->saveMany($poItems);

        event(new PurchaseOrderWasCreated($purchaseorder));

        return $purchaseorder;
    }
}
