<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateItemReceiptCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\ItemReceiptRepository;
use Nixzen\Models\ItemReceiptItem;
use Nixzen\Events\ItemReceiptWasUpdated;
class UpdateItemReceiptCommandHandler
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
     * @param  UpdateItemReceiptCommand  $command
     * @return void
     */
    public function handle(UpdateItemReceiptCommand $command)
    {
				$command->itemreceipt->update([
	          'date'           	=> $command->date,
	          'remarks'        	=> $command->remarks
	      ]);
	      foreach($command->items as $item){
		      $command->itemreceipt->items()->update((array) $item);
	      }
				event(new ItemReceiptWasUpdated($command->itemreceipt));
    }
}
