<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface; 
use Nixzen\Repositories\Base\Repository;

class ItemCategoryRepository extends Repository{
	
	public function model()
	{
		return 'Nixzen\ItemCategory';
	}
}
