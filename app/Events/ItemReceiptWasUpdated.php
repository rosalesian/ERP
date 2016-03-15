<?php

namespace Nixzen\Events;

use Nixzen\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemReceiptWasUpdated extends Event
{
    use SerializesModels;

		public $itemreceipt;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($itemreceipt)
    {
        $this->itemreceipt = $itemreceipt;
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
