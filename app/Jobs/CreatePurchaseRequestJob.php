<?php

namespace Nixzen\Jobs;

use Nixzen\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Nixzen\Models\Access;

class CreatePurchaseRequestJob extends Job implements SelfHandling
{
    public $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Access $access)
    {
        dd($access);
    }
}
