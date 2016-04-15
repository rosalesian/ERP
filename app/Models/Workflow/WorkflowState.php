<?php namespace Nixzen\Models\Workflow;

use Illuminate\Database\Eloquent\Model;

class WorkflowState extends Model {

	protected $table = 'workflow_states';

	protected $primary_key = 'id';

	protected $cast = [
		'exitworkflow' => 'boolean'
	];

	protected $fillable = ['name', 'description','workflow_id', 'exitworkflow'];

	public function workflow(){
		return $this->belongsTo('Nixzen\Models\Workflow\Workflow', 'workflow_id');
	}

	public function actions(){
		return $this->hasMany('Nixzen\Models\Workflow\WorkflowStateAction', 'state_id');
	}

	public function transitions(){
		return $this->hasMany('Nixzen\Models\Workflow\WorkflowStateTransition', 'state_id');
	}

	public function position(){
		return $this->hasOne('Nixzen\Models\StatePosition', 'state_id');
	}

}
