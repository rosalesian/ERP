<?php namespace Nixzen\Repositories\Base;

use Nixzen\Repositories\Base\RepositoryInterface;

abstract class Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, RepositoryInterface $repository);
}
