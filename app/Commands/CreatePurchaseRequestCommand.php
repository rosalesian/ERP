<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;
use Nixzen\Http\Requests;

class CreatePurchaseRequestCommand extends Command
{
	public $requestedby;

	public $type;

	public $date;

	public $remarks;

	public $items;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($requestedby, $type, $date, $remarks, $items)
    {
		$this->requestedby = $requestedby;
		$this->type = $type;
		$this->date = $date;
		$this->remarks = $remarks;
		$this->items = $items;
    }
}
