<?php
namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdatePurchaseRequestCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\PurchaseRequestRepository;
use Nixzen\Models\PurchaseRequestItem;
use Nixzen\Events\PurchaseRequestWasUpdated;

class UpdatePurchaseRequestCommandHandler
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
     * @param  UpdatePurchaseRequestCommand  $command
     * @return void
     */
    public function handle(UpdatePurchaseRequestCommand $command)
    {
		$purchaserequest = $this->purchaserequest->update([
			'type_id' => $command->type_id,
			'date' => $command->date,
			'requester' => $command->requester,
			'deliver_to' => $command->deliver_to,
			'remarks' => $command->remarks
		], $command->purchaserequest->id);

		$this->purchaserequest->saveWith($command->purchaserequest->id, [
			'items' => $command->items
		]);

        event(new PurchaseRequestWasUpdated($command->purchaserequest));
    }
}
