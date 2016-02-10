<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface; 
use Nixzen\Repositories\Base\Repository;

class JobOrderTypeRepository extends Repository{
	
	public function model()
	{
		return 'Nixzen\Models\Item\JobOrderType';
	}
}
