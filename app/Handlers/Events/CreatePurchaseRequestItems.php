<?php

namespace Nixzen\Handlers\Events;

use Nixzen\Events\PurchaseRequestWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Nixzen\Repositories\PurchaseRequestItemRepository;
use Nixzen\Models\PurchaseRequestItem;

class CreatePurchaseRequestItems
{
    public $request;

    public $item;
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct(Request $request, PurchaseRequestItemRepository $item)
    {
        $this->request = $request;
        $this->item = $item;
    }

    /**
     * Handle the event.
     *  
     * @param  PurchaseRequestWasCreated  $event
     * @return void
     */
    public function handle(PurchaseRequestWasCreated $event)
    {
        $purchaserequest = $event->purchaserequest;
        $input = $this->request->only('items');
        $items = json_decode($input['items']);
        $prItems = [];      
        foreach ($items as $item){
            array_push($prItems, new PurchaseRequestItem((array)$item));
        }
        $purchaserequest->items()->saveMany($prItems);
    }
}
