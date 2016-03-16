<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class CreatePurchaseOrderCommand extends Command
{
	public $vendor_id;

	public $type_id;

  public $terms_id;

	public $date;

	public $memo;

  public $paymentType_id;

	public $items;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($vendor_id, $type_id, $terms_id, $date, $memo, $paymenttype_id, $items)
    {
        $this->vendor_id 	    = $vendor_id;
        $this->type_id 	    	= $type_id;
        $this->terms_id       = $terms_id;
        $this->date 	    		= $date;
        $this->memo	    			= $memo;
        $this->paymentType_id = $paymenttype_id;

				if(gettype($items) == "string"){
						$this->items				= json_decode($items);
				}
				else{
					$this->items					= $items;
				}
    }
}
