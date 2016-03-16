<?php

namespace Nixzen\Events;

use Nixzen\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PurchaseOrderwasUpdated extends Event
{
    use SerializesModels;

    public $purchaseorder;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($purchaseorder)
    {
        $this->purchaseorder = $purchaseorder;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
