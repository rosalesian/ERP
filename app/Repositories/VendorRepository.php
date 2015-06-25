<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class VendorRepository extends Repository{
	
	public function model()
	{
		return 'Nixzen\Vendor';
	}
}
