<?php namespace Nixzen\Repositories;


use Nixzen\Repositories\Base\RepositoryInterface; 
use Nixzen\Repositories\Base\Repository;

class RoleRepository extends Repository {

    public function model() {
        return 'Nixzen\Role';
    }
}