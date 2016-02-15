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
        $this->purchaserequest->create([
            'requester' => $command->requester,
            'type' => $command->type,
            'date' => $command->date,
            'remarks' => $command->remarks 
        ]);

        $prItems = [];
        
        foreach($command->items as $item){
            array_push($prItems, new PurchaseRequestItem((array)$item));
        }
        $this->purchaserequest->items()->saveMany($prItems);

        event(new PurchaseRequestWasUpdated($purchaserequest, $items));
    }
}