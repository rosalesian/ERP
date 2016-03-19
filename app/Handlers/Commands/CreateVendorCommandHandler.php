<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateVendorCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\VendorRepository;
use Nixzen\Events\VendorWasCreated;

class CreateVendorCommandHandler
{
		public $vendor;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(VendorRepository $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * Handle the command.
     *
     * @param  CreateVendorCommand  $command
     * @return void
     */
    public function handle(CreateVendorCommand $command)
    {
			$vendor = $this->vendor->create((array) $command);
			event(new VendorWasCreated($vendor));
			return $vendor;
    }
}
