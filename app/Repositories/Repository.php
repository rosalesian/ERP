<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository as BaseRepository;
//use Context;

class Repository extends BaseRepository {

	public function __construct(/*Context $context*/){

		$this->model->setConnection($context->getConnection);
	}

	public function model()
	{
		return $this->$model_param;
	}
}