<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface;
use Nixzen\Repositories\Base\Repository;
use Nizen\Repositories\Item;


class ItemRepository extends Repository{

	public function model()
	{
		return 'Nixzen\Models\Item';
	}
	
}
