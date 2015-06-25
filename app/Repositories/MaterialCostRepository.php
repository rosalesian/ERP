<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class MaterialCostRepository extends Repository {

    public function model() {
        return 'Nixzen\MaterialCost';
    }
}