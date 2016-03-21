<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkflowDispatcherTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldDispatchWorkflow()
    {
        $workflow = new WorkflowServices();

				$workflow->run($model);

				
    }
}
