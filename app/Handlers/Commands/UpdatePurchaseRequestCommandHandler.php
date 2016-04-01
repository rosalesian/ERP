<?php
namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdatePurchaseRequestCommand;
use Illuminate\Queue\InteractsWithQueue;
use Nixzen\Repositories\PurchaseRequestRepository;
use Nixzen\Models\PurchaseRequestItem;
use Nixzen\Events\PurchaseRequestWasUpdated;

class UpdatePurchaseRequestCommandHandler
{
    public $purchaserequest;
     /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {}

    /**
     * Handle the command.
     *
     * @param  UpdatePurchaseRequestCommand  $command
     * @return void
     */
    public function handle(UpdatePurchaseRequestCommand $command)
    {
		$this->purchaserequest = $command->purchaserequest;
        $this->purchaserequest->update((array)$command);

		$this->saveLineItems($command->items);

        event(new PurchaseRequestWasUpdated($command->purchaserequest));
    }

	public function saveLineItems($inputs)
	{
		$lineitems = $this->purchaserequest->items();

		foreach($inputs as $data)
		{
			$lineitem = $lineitems->where('item_id', $data->item_id)
							      ->where('unit_id', $data->unit_id)
							      ->first();

			if($lineitem == null)
			{
				$this->purchaserequest->items()->create((array)$data);
			}else
			{
				$lineitem->update((array)$data);
			}
		}
	}

	public function cleanLineItem($inputs)
	{
		$lineitems = $this->purchaserequest->items();
		$result = array_diff( $lineitems->get(['id']), (array)$inputs);

	}
}
