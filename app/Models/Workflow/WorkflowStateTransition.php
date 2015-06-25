<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class WorkflowStateTransition extends Model {

	protected $table = 'workflow_state_transitions';

	protected $primary_key = 'id';

	public function state(){
		return $this->belongsTo('Nixzen\WorkflowState', 'state_id');
	}


}
