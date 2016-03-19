<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateVendorCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Events\VendorWasUpdated;

class UpdateVendorCommandHandler
{
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the command.
     *
     * @param  UpdatedVendorCommand  $command
     * @return void
     */
    public function handle(UpdateVendorCommand $command)
    {
				$data = array_except((array) $command, ['vendor']);
        $command->vendor->update($data);
				event(new VendorWasUpdated($command->vendor));
    }
}
