<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface; 
use Nixzen\Repositories\Base\Repository;

class MaterialCostRepository extends Repository {

    public function model() {
        return 'Nixzen\MaterialCost';
    }
}