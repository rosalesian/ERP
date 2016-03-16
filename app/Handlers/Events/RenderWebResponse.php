<?php

namespace Nixzen\Handlers\Events;

use Nixzen\Events\PurchaseRequestWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
class RenderWebResponse
{

    public $request;
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        dd($this->request->only('items'));
        return redirect()->route('purchaserequest.show', $purchaserequest->id);
    }
}
