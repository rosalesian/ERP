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
    public function __construct(PurchaseOrderRepository $purchaseorder)
    {
		$this->purchaseorder = $purchaseorder;
    }

    /**
     * Handle the command.
     *
     * @param  UpdatePurchaseOrderCommand  $command
     * @return void
     */
    public function handle(UpdatePurchaseOrderCommand $command)
    {
		$purchaseorder = $this->purchaseorder->update([
			'vendor_id' => $command->vendor_id,
			'terms_id' => $command->terms_id,
			'date' => $command->date,
			'type_id' => $command->type_id,
			'paymenttype_id' => $command->paymenttype_id,
			'memo' => $command->memo
		], $command->purchaseorder->id);

		$this->purchaseorder->saveWith($command->purchaseorder->id, [
			'items' => $command->items
		]);

        event(new PurchaseOrderWasUpdated($command->purchaseorder));
    }
}
