<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateItemCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\ItemRepository;
use Nixzen\Events\ItemWasUpdated;

class UpdateItemCommandHandler
{
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the command.
     *
     * @param  UpdateItemCommand  $command
     * @return void
     */
    public function handle(UpdateItemCommand $command)
    {
				$data = array_except((array) $command, ['item']);
        $command->item->update($data);
				event(new ItemWasUpdated($command->item));
    }
}
