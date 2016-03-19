<?php

namespace Nixzen\Listeners;

use Nixzen\Events\ItemReceiptWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionEventListener
{
    /**
     * Create the event listener.
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
     * @param  ItemReceiptWasCreated  $event
     * @return void
     */
    public function handle(ItemReceiptWasCreated $event)
    {
        //
    }
}
