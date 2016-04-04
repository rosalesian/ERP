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
		$itemreceipt = $command->itemreceipt;

		$itemreceipt->date = $command->date;
		$itemreceipt->remarks = $command->remarks;

		$itemreceipt->updateLineItems($command->items);

		event(new ItemReceiptWasUpdated($command->itemreceipt));
    }
}
