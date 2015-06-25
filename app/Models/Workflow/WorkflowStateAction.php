<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;

class WorkflowStateAction extends Model {

	protected $table = 'workflow_state_actions';

	protected $primary_key = 'id';

	public function state(){
		return $this->belongsTo('Nixzen\WorkflowState', 'state_id');
	}
}
