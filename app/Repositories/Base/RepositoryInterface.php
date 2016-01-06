<?php namespace Nixzen\Repositories;

//use Bosnadev\Repositories\Contracts\RepositoryInterface;
//use Bosnadev\Repositories\Eloquent\Repository as BaseRepository;
//use Context;

interface RepositoryInterface{

	public function all();

	public function find($id);

	public function create([], $id);

	public function update([], $id);
}