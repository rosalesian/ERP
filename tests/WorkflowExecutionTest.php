<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Nixzen\Events\PurchaseRequestWasCreated;

class WorkflowExecutionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShouldRunWorkflowProcess()
    {
				$purchaserequest = factory(Nixzen\Models\PurchaseRequest::class)->make();
        event(new PurchaseRequestWasCreated($purchaserequest));
    }
}
