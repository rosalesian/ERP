<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class UpdatePurchaseRequestCommand extends Command
{
	public $requester;

	public $type_id;

	public $date;

	public $remarks;

	public $items;

	public $deliver_to;

    public $purchaserequest;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($purchaserequest, $requester, $type_id, $deliver_to, $date, $remarks, $items)
    {
        $this->purchaserequest = $purchaserequest;
        $this->requester = $requester;
        $this->type_id = $type_id;
        $this->date = $date;
        $this->remarks = $remarks;
		$this->deliver_to = $deliver_to;
		if(gettype($items) == 'string')
		{
				$this->items = json_decode($items);
		}
		else
		{
				$this->items = $items;
		}
    }
}
