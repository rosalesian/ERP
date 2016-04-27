<?php

namespace Nixzen\Events;

use Nixzen\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class JobOrderWasUpdatedEvent extends Event
{
    use SerializesModels;

    public $joborder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($joborder)
    {
        $this->joborder = $joborder;
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
