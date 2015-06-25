<?php namespace Nixzen\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class VendorCategoryRepository extends Repository {

    public function model() {
        return 'Nixzen\VendorCategory';
    }
}