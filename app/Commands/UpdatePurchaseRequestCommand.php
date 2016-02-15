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

    public $id
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($id, $requester, $type, $date, $remarks, $items)
    {
        $this->id = $id;
        $this->requester = $requester;
        $this->type = $type;
        $this->date = $date;
        $this->remarks = $remarks;
        $this->items = $items;        
    }
}
