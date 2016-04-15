<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateJobOrderCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\JobOrderRepository;
use Nixzen\Events\JobOrderWasUpdatedEvent;

class UpdateJobOrderCommandHandler
{
    public $joborder;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(JobOrderRepository $joborder)
    {
        $this->joborder = $joborder;
    }

    /**
     * Handle the command.
     *
     * @param  UpdateJobOrderCommand  $command
     * @return void
     */
    public function handle(UpdateJobOrderCommand $command)
    {
        $joborder = $this->joborder->update([
                'transdate' => $command->transdate,
                'transnumber' => $command->transnumber,
                'asset_id' => $command->asset_id,
                'requested_by' => $command->requested_by,
                'maintenancetype_id' => $command->maintenancetype_id,
                'prcategory_id' => $command->prcategory_id,
                'memo' => $command->memo
            ], $command->joborder);

        $this->joborder->saveWith($command->joborder, ['laborItems' => $command->labor_costs]);
        event(new JobOrderWasUpdatedEvent($command->joborder));
        return $joborder;
    }
}
