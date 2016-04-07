<?php namespace Nixzen\Repositories;

use Nixzen\Repositories\Base\RepositoryInterface;
use Nixzen\Repositories\Base\Repository;

class CustomerRepository extends Repository{

	public function model()
	{
		return 'Nixzen\Models\Customer';
	}
}
