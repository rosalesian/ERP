<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\CreateItemReceiptCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Events\ItemReceiptWasCreated;
use Nixzen\Repositories\ItemReceiptRepository;

class CreateItemReceiptCommandHandler
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
     * @param  CreateItemReceiptCommand  $command
     * @return void
     */
    public function handle(CreateItemReceiptCommand $command)
    {
		$itemreceipt = $this->itemreceipt->create([
			'date' => $command->date,
			'remarks' => $command->remarks,
			'purchaseorder_id' => $command->purchaseorder->id
		]);

		$this->itemreceipt->saveWith($itemreceipt->id, [
			'items' => $command->items
		]);

		event(new ItemReceiptWasCreated($itemreceipt));

		return $itemreceipt;
    }
}
