<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class ActiveWorkflow extends Model {


	protected $table = 'active_workflows';

	protected $primary_key = 'id';

	protected $fillable = ['workflow_id', 'state_id', 'recrodtype', 'record_id'];

	public function recordtype(){
		return $this->belongsTo('Nixzen\RecordType', 'recordtype_id');
	}

	public function workflow(){
		return $this->belongsTo('Nixzen\Workflow', 'workflow_id');
	}

	public function currentState(){
		return $this->belongsTo('Nixzen\WorkflowState', 'state_id');
	}
}
