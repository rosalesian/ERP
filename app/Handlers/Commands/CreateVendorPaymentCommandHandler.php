<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateVendorPaymentCommand;
use Nixzen\Repositories\VendorPaymentRepository;
use Nixzen\Events\VendorPaymentWasCreated;

use Illuminate\Queue\InteractsWithQueue;

class CreateVendorPaymentCommandHandler
{
		public $vendorpayment;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(VendorPaymentRepository $vendorpayment)
    {
        $this->vendorpayment = $vendorpayment;
    }

    /**
     * Handle the command.
     *
     * @param  CreateVendorPaymentCommand  $command
     * @return void
     */
    public function handle(CreateVendorPaymentCommand $command)
    {
        $vendorpayment = $this->vendorpayment->create((array) $command);
				foreach($command->items as $item){
					$vendorpayment->items()->create((array) $item);
				}
				event(new VendorPaymentWasCreated($vendorpayment));
				return $vendorpayment;
    }
}
