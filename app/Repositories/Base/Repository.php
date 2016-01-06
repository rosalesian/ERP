<?php namespace Nixzen\Repositories\Base;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository as BaseRepository;
//use Context;

class Repository extends BaseRepository{	

	public function model(){	
		return;
	}
/*	public abstract function beforeSubmit();

	public abstract function afterSubmit();*/

    public function save($data, $id){
    	$this->beforeSubmit();
    	//create
    	if($id == null){
    		$this->create($data);
    	}
    	//update
    	else{
    		$this->update($data, $id);
    	}    	
    	$this->afterSubmit();
    }
}