<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;
use Nixzen\Http\Requests;

class CreatePurchaseRequestCommand extends Command
{
	public $requester;

	public $type;

	public $date;

	public $remarks;

	public $items;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($requester, $type, $date, $remarks, $items)
    {
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
