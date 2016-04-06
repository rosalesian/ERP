<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateVendorBillCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\VendorBillRepository as VendorBill;

class UpdateVendorBillCommandHandler
{

    private $vendorbill;

    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(VendorBill $vendorbill)
    {
        $this->vendorbill = $vendorbill;
    }

    /**
     * Handle the command.
     *
     * @param  UpdateVendorBillCommand  $command
     * @return void
     */
    public function handle(UpdateVendorBillCommand $command)
    {

        $data = (array)$command;
        
        unset(
            $data['items'],
            $data['expenses'],
            $data['vendorbill']
        );

        $this->vendorbill->update($data, $command->vendorbill);

        if($command->items)
        {

            $this->vendorbill->saveWith($command->vendorbill, [
                    'items' => $command->items
                ]);
        }

        if($command->expenses)
        {

            $this->vendorbill->saveWith($command->vendorbill, [
                    'expenses' => $command->expenses
                ]);
        }
    }
}
