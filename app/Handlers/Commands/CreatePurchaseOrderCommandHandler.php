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
            'vendor_id'        => $command->vendor_id,
            'terms_id'         => $command->terms_id,
            'date'          => $command->date,
            'type_id'          => $command->type_id,
            'paymenttype_id'   =>$command->paymentType_id,
            'memo'       => $command->memo
        ]);

        foreach($command->items as $item){
			$purchaseorder->items()->create((array)$item);
        }

        event(new PurchaseOrderWasCreated($purchaseorder));

        return $purchaseorder;
    }
}
