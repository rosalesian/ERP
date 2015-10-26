<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
//use Nixzen\Repositories\Base\Repository;

class PurchaseRequestRepository extends Repository {

	function model(){
		return 'Nixzen\Models\PurchaseRequest';
	}
}