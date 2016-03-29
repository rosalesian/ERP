<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateVendorBillCommand;
use Illuminate\Queue\InteractsWithQueue;

class UpdateVendorBillCommandHandler
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
     * @param  UpdateVendorBillCommand  $command
     * @return void
     */
    public function handle(UpdateVendorBillCommand $command)
    {
        $command->vendorbill->update((array)$command);

        foreach($command->items as $item){
            $command->vendorbill->items()->update((array)$item);
        }

        foreach($command->expenses as $expense){
            $command->vendorbill->expenses()->update((array)$expense);
        }
    }
}
