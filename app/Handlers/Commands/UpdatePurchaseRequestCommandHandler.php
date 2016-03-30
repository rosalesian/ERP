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
    {
    }

    /**
     * Handle the command.
     *
     * @param  UpdatePurchaseRequestCommand  $command
     * @return void
     */
    public function handle(UpdatePurchaseRequestCommand $command)
    {
        $command->purchaserequest->update((array)$command);
				$lineitems = $command->purchaserequest->items();

        foreach($command->items as $item){
						$prItem = $command->purchaserequest
											->items()
											->where('item_id', $item->item_id)
											->where('unit_id', $item->unit_id)
											->first();

						if($prItem == null){
							$command->purchaserequest->items()->create((array)$item);
						}else{
							$prItem->update((array)$item);
						}
        }
        event(new PurchaseRequestWasUpdated($command->purchaserequest));
    }

		public function cleanLineItem($lineitem)
		{

		}
}
