<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
//use Nixzen\Repositories\Repository;

class WorkflowStateRepository extends Repository{

	public function model()
	{
		return 'Nixzen\Models\Workflow\WorkflowState';
	}
}
