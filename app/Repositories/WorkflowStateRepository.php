<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface; 
use Nixzen\Repositories\Base\Repository;
//use Nixzen\Repositories\Repository;

class WorkflowStateRepository extends Repository{

	public function model()
	{
		return 'Nixzen\Models\Workflow\WorkflowState';
	}
}
