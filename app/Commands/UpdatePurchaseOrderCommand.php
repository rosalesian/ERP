<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class UpdatePurchaseOrderCommand extends Command
{
	public $vendor;

	public $type;

	public $date;

	public $remarks;

	public $items;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($vendor, $type, $date, $remarks, $items)
    {
        $this->vendor 	= $vendor;
        $this->type 	= $type;
        $this->date 	= $date;
        $this->remarks 	= $remarks;
        $this->items 	= $items;
    }
}
