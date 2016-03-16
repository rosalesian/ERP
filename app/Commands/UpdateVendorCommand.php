<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;

class UpdateVendorCommand extends Command
{
	public $name;
	public $description;
	public $email;
	public $phone;
	public $faxno;
	public $contact_person;
	public $vendorcategories_id;
	public $tin;
	public $branch_id;
	public $taxcode_id;
	public $term_id;
	public $vendor;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(
		$name,
		$description,
		$email,
		$phone,
		$faxno,
		$contact_person,
		$vendorcategories_id,
		$tin,
		$branch_id,
		$taxcode_id,
		$term_id,
		$vendor
	)
	{
			$this->name = $name;
			$this->description = $description;
			$this->email = $email;
			$this->phone = $phone;
			$this->faxno = $faxno;
			$this->contact_person = $contact_person;
			$this->vendorcategories_id = $vendorcategories_id;
			$this->tin = $tin;
			$this->branch_id = $branch_id;
			$this->taxcode_id = $taxcode_id;
			$this->term_id = $term_id;
			$this->vendor = $vendor;
	}
}
