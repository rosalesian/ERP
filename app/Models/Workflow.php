<?php namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model {


	protected $table = 'workflows';

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
