<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreatePurchaseRequestCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\PurchaseRequestRepository;
use Nixzen\Models\PurchaseRequestItem;
use Nixzen\Events\PurchaseRequestWasCreated;

class CreatePurchaseRequestCommandHandler
{
    public $purchaserequest;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(PurchaseRequestRepository $purchaserequest)
    {
        $this->purchaserequest = $purchaserequest;
    }

    /**
     * Handle the command.
     *
     * @param  CreatePurchaseRequestCommand  $command
     * @return void
     */
    public function handle(CreatePurchaseRequestCommand $command)
    {
        $purchaserequest = $this->purchaserequest->create([
			'requester' => $command->requester,
			'type_id' => $command->type_id,
			'date' => $command->date,
			'remarks' => $command->remarks,
			'deliver_to' => $command->deliver_to,
		]);

		$this->purchaserequest->saveWith($purchaserequest->id, [
			'items' => $command->items
		]);

        event(new PurchaseRequestWasCreated($purchaserequest));
        return $purchaserequest;
    }
}
