<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateItemReceiptCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\ItemReceiptRepository;
use Nixzen\Events\ItemReceiptWasUpdated;

class UpdateItemReceiptCommandHandler
{
	protected $itemreceipt;
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct(ItemReceiptRepository $itemreceipt)
    {
		$this->itemreceipt = $itemreceipt;
    }

    /**
     * Handle the command.
     *
     * @param  UpdateItemReceiptCommand  $command
     * @return void
     */
    public function handle(UpdateItemReceiptCommand $command)
    {

		$itemreceipt = $this->itemreceipt->update([
			'date'	=> $command->date,
			'remarks' => $command->remarks
		], $command->itemreceipt->id);

		$this->itemreceipt->saveWith($itemreceipt, [
			'items' => $command->items
		]);

		event(new ItemReceiptWasUpdated($command->itemreceipt));
    }
}
