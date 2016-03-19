<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateVendorPaymentCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Events\VendorPaymentWasUpdated;

class UpdateVendorPaymentCommandHandler
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
     * @param  UpdateVendorPaymentCommand  $command
     * @return void
     */
    public function handle(UpdateVendorPaymentCommand $command)
    {
				$command->vendorpayment->update((array) $command);
				foreach($command->items as $item){
					$command->vendorpayment->items()->update((array) $item);
				}
				event(new VendorPaymentWasUpdated($command->vendorpayment));
    }
}
