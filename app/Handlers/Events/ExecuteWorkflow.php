<?php

namespace Nixzen\Handlers\Events;

use Nixzen\Events\PurchaseRequestWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Nixzen\Models\Workflow;

class ExecuteWorkflow
{
		public $workflow;
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct(Workflow $workflow)
    {
        $this->workflow = $workflow;
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

				//workflow setup
				$workflows_setup = $this->workflow
													->where('recordtype_id', $purchaserequest->recordType_id)
													->get();

				//dd("hello");
				$workflow->each(function($workflow){
					$purchaserequest->workflows()->create([
						'recordtype_id' => $workflow->recordtype_id,
						'workflow_setup_id' => $workflow->id,
						'current_state_id' => $worfklow->states()[0]
					]);
				});
    }
}
