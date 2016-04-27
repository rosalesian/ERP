<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;
use Nixzen\Http\Requests;

class CreatePurchaseRequestCommand extends Command
{
	public $requester;

	public $type_id;

	public $date;

	public $remarks;

	public $deliver_to;

	public $items;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($requester, $type_id, $date, $deliver_to, $remarks, $items)
    {
				$this->requester = $requester;
				$this->type_id = $type_id;
				$this->date = $date;
				$this->remarks = $remarks;
				$this->deliver_to = $deliver_to;

				if(gettype($items) == 'string')
				{
						$this->items = json_decode($items);
				}
				else {
						$this->items = $items;
				}
    }
}
