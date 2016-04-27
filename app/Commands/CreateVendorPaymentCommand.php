<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class CreateVendorPaymentCommand extends Command
{
		public $transno;
		public $coa_id;
		public $payee_id;
		public $date;
		public $posting_period_id;
		public $checkno;
		public $checkdate;
		public $principal_id;
		public $branch_id;
		public $items;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
			$transno,
			$coa_id,
			$payee_id,
			$date,
			$posting_period_id,
			$checkno,
			$checkdate,
			$principal_id,
			$branch_id,
			$items
		)
    {
        $this->transno = $transno;
				$this->coa_id = $coa_id;
				$this->payee_id = $payee_id;
				$this->date = $date;
				$this->posting_period_id = $posting_period_id;
				$this->checkno = $checkno;
				$this->checkdate = $checkdate;
				$this->principal_id = $principal_id;
				$this->branch_id = $branch_id;
				if(gettype($items) == 'string'){
					$this->items = json_decode($items);
				}else{
					$this->items = $items;
				}
    }
}
