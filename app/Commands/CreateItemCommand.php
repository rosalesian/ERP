<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class CreateItemCommand extends Command
{
		public $itemcode;
		public $description;
		public $unittype_id;
		public $itemtype_id;
		public $default_purchaseunit_id;
		public $default_salesunit_id;
		public $default_stockunit_id;
		public $itemcategory_id;
		public $expensecategory_id;
		public $taxcode_id;
		public $account_id;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
			$itemcode,
			$description,
			$unittype_id,
			$itemtype_id,
			$default_purchaseunit_id,
			$default_salesunit_id,
			$default_stockunit_id,
			$itemcategory_id,
			$expensecategory_id,
			$taxcode_id,
			$account_id
		)
    {
			$this->itemcode = $itemcode;
			$this->description = $description;
			$this->unittype_id = $unittype_id;
			$this->itemtype_id = $itemtype_id;
			$this->default_purchaseunit_id = $default_purchaseunit_id;
			$this->default_salesunit_id = $default_salesunit_id;
			$this->default_stockunit_id = $default_stockunit_id;
			$this->itemcategory_id = $itemcategory_id;
			$this->expensecategory_id = $expensecategory_id;
			$this->taxcode_id = $taxcode_id;
			$this->account_id = $account_id;
    }
}
