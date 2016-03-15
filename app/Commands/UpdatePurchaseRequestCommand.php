<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class UpdatePurchaseRequestCommand extends Command
{
	public $requester;

	public $type;

	public $date;

	public $remarks;

	public $items;

    public $purchaserequest;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($purchaserequest, $requester, $type, $date, $remarks, $items)
    {
        $this->purchaserequest = $purchaserequest;
        $this->requester = $requester;
        $this->type = $type;
        $this->date = $date;
        $this->remarks = $remarks;
				if(gettype($items) == 'string')
				{
						$this->items = json_decode($items);
				}
				else {
						$this->items = $items;
				}
    }
}
