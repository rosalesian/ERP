<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class CreateItemReceiptCommand extends Command
{
    public $purchaseorder;

    public $date;

    public $remarks;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($purchaseorder, $date, $remarks)
    {
        $this->purchaseorder  = $purchaseorder;
        $this->date           = $date;
        $this->remarks        = $remarks;
    }
}
