<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateVendorPaymentCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Events\VendorPaymentWasUpdated;
use Nixzen\Repositories\VendorPaymentRepository;

class UpdateVendorPaymentCommandHandler
{
	protected $vendorpayment;

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
     * @param  UpdateVendorPaymentCommand  $command
     * @return void
     */
    public function handle(UpdateVendorPaymentCommand $command)
    {
		//$command->vendorpayment->update((array) $command);
		$vendorpayment = $this->vendorpayment->update([
			'transno' => $command->transno,
			'coa_id' => $command->coa_id,
			'date' => $command->date,
			'payee_id' => $command->payee_id,
			'posting_period_id' => $command->posting_period_id,
			'checkno' => $command->checkno,
			'checkdate' => $command->checkdate,
			'principal_id' => $command->principal_id,
			'branch_id' => $command->branch_id,
		], $command->vendorpayment->id);

		$this->vendorpayment->saveWith($vendorpayment, [
			'items' => $command->items
		]);

		event(new VendorPaymentWasUpdated($command->vendorpayment));
    }
}
