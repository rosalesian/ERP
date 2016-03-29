<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateVendorBillCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\VendorBillRepository as VendorBill;

class CreateVendorBillCommandHandler
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
     * @param  CreateVendorBillCommand  $command
     * @return void
     */
    public function handle(CreateVendorBillCommand $command)
    {

        $vendorbill = $this->vendorbill->create((array)$command);
/*
        foreach($command->items as $item){
            $vendorbill->items()->create((array)$item);
        }

        foreach($command->expenses as $expense){
            $vendorbill->expenses()->create((array)$expense);
        }
*/
        return $vendorbill;
    }
}
