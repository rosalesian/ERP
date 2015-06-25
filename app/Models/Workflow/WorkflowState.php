<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class WorkflowState extends Model {

	protected $table = 'workflow_states';

	protected $primary_key = 'id';

	protected $cast = [
		'exitworkflow' => 'boolean'
	];

	public function workflow(){
		return $this->belongsTo('Nixzen\Workflow', 'workflow_id');
	}

	public function actions(){
		return $this->hasMany('Nixzen\WorkflowStateAction', 'state_id');
	}

	public function transitions(){
		return $this->hasMany('Nixzen\WorkflowStateTransition', 'state_id');
	}

}
