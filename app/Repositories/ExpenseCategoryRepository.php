<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class ExpenseCategoryRepository extends Repository{
	
	public function model()
	{
		return 'Nixzen\ExpenseCategory';
	}
}
