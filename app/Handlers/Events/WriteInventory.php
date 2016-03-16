<?php

namespace Nixzen\Handlers\Events;

use Nixzen\Events\ItemReceiptWasCreate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WriteInventory
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ItemReceiptWasCreate  $event
     * @return void
     */
    public function handle(ItemReceiptWasCreate $event)
    {
        $itemreceipt = $event->itemreceipt;


    }
}
