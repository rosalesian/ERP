<?php namespace Nixzen\Repositories\Criteria\Films;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

use Nixzen\Repositories\Base\RepositoryInterface;

class ScopeForVendor extends Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('vendor_id', '=', /*the vendor of the user*/);
        return $model;
    }
}
