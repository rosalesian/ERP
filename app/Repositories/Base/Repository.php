<?php namespace Nixzen\Repositories\Base;

use Nixzen\Repositories\Base\CriteriaInterface;
use Nixzen\Repositories\Base\Criteria;
use Nixzen\Repositories\Base\RepositoryInterface;
use Nixzen\Repositories\Base\RepositoryException;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface, CriteriaInterface {

    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    protected $with;

    /**
     * @param App $app
     * @param Collection $collection
     * @throws Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app, Collection $collection) {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public abstract function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        $this->applyCriteria();
        $this->newQuery()->eagerLoadRelations();
        return $this->model->get($columns);
    }

    /**
     * @param  string $value
     * @param  string $key
     * @return array
     */
    public function lists($value, $key = null) {
        $this->applyCriteria();
        $lists = $this->model->all(["$value as label","$key as value"]);
        if(is_array($lists)) {
            return $lists;
        }

    	return $lists->toJson();
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 1, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

	public function make(){
		return $this->model;
	}
    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute="id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param  array  $data
     * @param  $id
     * @return mixed
     */
    public function updateRich(array $data, $id) {
        if (!($model = $this->model->find($id))) {
            return false;
        }

        return $model->fill($data)->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($attribute, $value, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

	/**
	 * @param $attribute
	 * @param $value
	 * @param array $columns
	 * @return mixed
	 */
	public function firstOrCreate($columns, array $data) {
		$this->applyCriteria();
		$model = $this->model->where($columns)->first();
		if($model == null){
			$model = $this->model->create($data);
		}
		else {
			$model->update($data);
		}

		return $model;
	}
    /**
     * Find a collection of models by the given query conditions.
     *
     * @param array $where
     * @param array $columns
     * @param bool  $or
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findWhere($where, $columns = ['*'], $or = false)
    {
        $this->applyCriteria();

        $model = $this->model;

        foreach ($where as $field => $value) {
            if ($value instanceof \Closure) {
                $model = (! $or)
                    ? $model->where($value)
                    : $model->orWhere($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;
                    $model = (! $or)
                        ? $model->where($field, $operator, $search)
                        : $model->orWhere($field, $operator, $search);
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;
                    $model = (! $or)
                        ? $model->where($field, '=', $search)
                        : $model->orWhere($field, '=', $search);
                }
            } else {
                $model = (! $or)
                    ? $model->where($field, '=', $value)
                    : $model->orWhere($field, '=', $value);
            }
        }
        return $model->get($columns);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

	public function saveWith($id, array $relations)
	{

		foreach($relations as $relation => $inputs)
		{

			$lineitems = $this->model->findOrFail($id)->{$relation}();
			$ids = collect($inputs)->fetch('id')->toArray();

			foreach ($lineitems->get() as $key => $item)
			{
				if(! in_array($item->id, $ids))
				{
					$item->delete();
				}
			}

			foreach($inputs as $input)
			{
				$lineitems = $this->model->findOrFail($id)->{$relation}();

				$lineitem = $lineitems->updateOrCreate(
					['id' => $input->id],
					(array)$input
				);

			}
		}
	}

    /**
     * @return $this
     */
    public function with($relations){
        if(is_string($relations)) $relations = func_get_args();

        $this->with = $relations;

        return $this;
    }

    /**
     * @return $this
     */
    protected function eagerLoadRelations(){
        if(!is_null($this->with)){
            foreach($this->with as $relation){
                $this->model->with($relation);
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function newQuery(){
        $this->model = $this->model->newQuery();

        return $this;
    }
    /**
     * @return $this
     */
    public function resetScope() {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true){
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria() {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria) {
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria() {
        if($this->skipCriteria === true)
            return $this;

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }
}
