<?php

namespace Nixzen\Handlers\Events;

use Nixzen\Events\PurchaseRequestWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PurchaseRequestItemsHandler
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
     * @param  PurchaseRequestWasUpdated  $event
     * @return void
     */
    public function handle(PurchaseRequestWasUpdated $event)
    {
        //
    }
}
