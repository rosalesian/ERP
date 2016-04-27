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
		$vendorpayment = $this->vendorpayment->create([
			'transno' => $command->transno,
			'coa_id' => $command->coa_id,
			'date' => $command->date,
			'payee_id' => $command->payee_id,
			'posting_period_id' => $command->posting_period_id,
			'checkno' => $command->checkno,
			'checkdate' => $command->checkdate,
			'principal_id' => $command->principal_id,
			'branch_id' => $command->branch_id,
		]);

		$this->vendorpayment->saveWith($vendorpayment->id, [
			"items" => $command->items
		]);

		event(new VendorPaymentWasCreated($vendorpayment));
		return $vendorpayment;
    }
}
