<?php namespace Nixzen\Repositories\Base;

use Nixzen\Repositories\Base\RepositoryInterface as Repository;

abstract class Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}