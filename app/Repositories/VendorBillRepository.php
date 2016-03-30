<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface;
use Nixzen\Repositories\Base\Repository;

class VendorBillRepository extends Repository {

	function model(){
		return 'Nixzen\Models\VendorBill';
	}

}
