<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateItemCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\ItemRepository;
use Nixzen\Events\ItemWasCreated;

class CreateItemCommandHandler
{
		protected $item;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(ItemRepository $item)
    {
        $this->item = $item;
    }

    /**
     * Handle the command.
     *
     * @param  CreateItemCommand  $command
     * @return void
     */
    public function handle(CreateItemCommand $command)
    {
        $item = $this->item->create((array) $command);
				event(new ItemWasCreated($item));
				return $item;
    }
}
