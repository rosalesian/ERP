<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateItemReceiptCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Events\ItemReceiptWasCreated;

class CreateItemReceiptCommandHandler
{
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the command.
     *
     * @param  CreateItemReceiptCommand  $command
     * @return void
     */
    public function handle(CreateItemReceiptCommand $command)
    {
				$itemreceipt = $command->purchaseorder->itemreceipt()->create([
	          'date'		=> $command->date,
	          'remarks'	=> $command->remarks
	      ]);

	      foreach($command->items as $item){
					$itemreceipt->items()->create((array) $item);
	      }

				event(new ItemReceiptWasCreated($itemreceipt));

				return $itemreceipt;
    }
}
