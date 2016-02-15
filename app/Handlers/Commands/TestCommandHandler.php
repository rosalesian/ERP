<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\TestCommand;
use Illuminate\Queue\InteractsWithQueue;

class TestCommandHandler
{
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the command.
     *
     * @param  TestCommand  $command
     * @return void
     */
    public function handle(TestCommand $command)
    {
        dd($command->message);
    }
}
