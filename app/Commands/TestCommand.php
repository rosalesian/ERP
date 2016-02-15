<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class TestCommand extends Command
{
	public $message;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
