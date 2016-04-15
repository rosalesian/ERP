<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class UpdateItemReceiptCommand extends Command
{
		public $itemreceipt;

		public $date;

		public $remarks;

		public $items;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($itemreceipt, $date, $remarks, $items)
    {
        $this->itemreceipt	=	$itemreceipt;
				$this->date						= $date;
				$this->remarks				= $remarks;

				if(gettype($items) == "string"){
					$this->items				= json_decode($items);
				}
				else {
					$this->items					= $items;
				}
    }
}
