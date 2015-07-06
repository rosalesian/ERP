<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class WorkflowRepository extends Repository{

	public function model()
	{
		return 'Nixzen\Models\Workflow\Workflow';
	}
}
