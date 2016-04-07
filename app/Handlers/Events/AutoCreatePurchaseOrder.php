<?php

namespace Nixzen\Handlers\Events;

use Nixzen\Events\PurchaseRequestWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AutoCreatePurchaseOrder
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
     * @param  PurchaseRequestWasCreated  $event
     * @return void
     */
    public function handle(PurchaseRequestWasCreated $event)
    {
    }
}
