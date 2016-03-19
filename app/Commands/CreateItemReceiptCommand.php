<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class CreateItemReceiptCommand extends Command
{
	  public $purchaseorder;

	  public $date;

	  public $remarks;

		public $items;
	  /**
	   * Create a new command instance.
	   *
	   * @return void
	   */
	  public function __construct($purchaseorder, $date, $remarks, $items)
	  {
		    $this->purchaseorder  = $purchaseorder;
		    $this->date           = $date;
		    $this->remarks        = $remarks;

				if(gettype($items) == "string"){
						$this->items				= json_decode($items);
				}
				else{
					$this->items					= $items;
				}
	  }
}
