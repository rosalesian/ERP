<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateJobOrderCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\JobOrderRepository;
use Nixzen\Events\JobOrderWasCreatedEvent;

class CreateJobOrderCommandHandler
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
     * @param  CreateJobOrderCommand  $command
     * @return void
     */
    public function handle(CreateJobOrderCommand $command)
    {
        $joborder = $this->joborder->create((array) $command);
        $this->joborder->saveWith($joborder->id, ['laborItems' => $command->labor_costs]);
        event(new JobOrderWasCreatedEvent($joborder));
        return $joborder;
    }
}
