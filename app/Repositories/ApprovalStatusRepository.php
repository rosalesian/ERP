<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface; 
use Nixzen\Repositories\Base\Repository;

class ApprovalStatusRepository extends Repository{
	
	public function model()
	{
		return 'Nixzen\ApprovalStatus';
	}
}
