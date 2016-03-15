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
        $command->purchaserequest->update([
            'requester' => $command->requester,
            'type' => $command->type,
            'date' => $command->date,
            'remarks' => $command->remarks
        ]);
        foreach($command->items as $item){
						$command->purchaserequest->update((array)$item);
        }
        event(new PurchaseRequestWasUpdated($command->purchaserequest));
    }
}
