<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface; 
use Nixzen\Repositories\Base\Repository;

class EmployeeRepository extends Repository{
	
	public function model()
	{
		return 'Nixzen\Models\Lists\Employee';
	}
}
