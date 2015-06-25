<?php namespace Nixzen\Repositories;

use Nixzen\Repositories\Repository;

class WorkflowRepository extends Repository{
	
	public function model()
	{
		return 'Nixzen\Workflow';
	}
}
