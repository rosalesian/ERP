<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class CreatePurchaseOrderCommand extends Command
{
	public $vendor;

	public $type;

  public $terms;

	public $date;

	public $remarks;

  public $paymentType;

	public $items;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($vendor, $type, $terms, $date, $remarks, $paymentType, $items)
    {
        $this->vendor 	    = $vendor;
        $this->type 	    = $type;
        $this->terms        = $terms;
        $this->date 	    = $date;
        $this->remarks	    = $remarks;
        $this->paymentType  = $paymentType;
        $this->items 	    = $items;
    }
}
