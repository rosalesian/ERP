<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdatePurchaseOrderCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\PurchaseOrderRepository;
use Nixzen\Models\PurchaseOrderItem;
use Nixzen\Events\PurchaseOrderWasUpdated;

class UpdatePurchaseOrderCommandHandler
{
    public $purchaseorder;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the command.
     *
     * @param  UpdatePurchaseOrderCommand  $command
     * @return void
     */
    public function handle(UpdatePurchaseOrderCommand $command)
    {
		$purchaseorder = $command->purchaseorder;

		$purchaseorder->vendor_id = $command->vendor_id;
		$purchaseorder->terms_id = $command->terms_id;
		$purchaseorder->date = $command->date;
		$purchaseorder->type_id = $command->type_id;
		$purchaseorder->paymenttype_id = $command->paymenttype_id;
		$purchaseorder->memo = $command->memo;
		$purchaseorder->save();

		$purchaseorder->updateLineItems($command->items);

        event(new PurchaseOrderWasUpdated($command->purchaseorder));
    }
}
