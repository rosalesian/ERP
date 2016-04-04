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
    public function __construct()
    {}

    /**
     * Handle the command.
     *
     * @param  UpdatePurchaseRequestCommand  $command
     * @return void
     */
    public function handle(UpdatePurchaseRequestCommand $command)
    {
        $purchaserequest = $command->purchaserequest;
		$purchaserequest->type_id = $command->type_id;
		$purchaserequest->date = $command->date;
		$purchaserequest->requester = $command->requester;
		$purchaserequest->deliver_to = $command->deliver_to;
		$purchaserequest->remarks = $command->remarks;
		$purchaserequest->save();

		$purchaserequest->updateLineItems($command->items);

        event(new PurchaseRequestWasUpdated($command->purchaserequest));
    }
}
