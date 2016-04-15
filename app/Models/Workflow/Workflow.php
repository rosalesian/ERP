<?php namespace Nixzen\Models\Workflow;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model {

	protected $table = 'workflows';

	protected $primary_key = 'id';

	protected $fillable = ['name', 'description', 'recordtype_id', 'condition'];

	public function states(){
		return $this->hasMany('Nixzen\Models\Workflow\WorkflowState', 'workflow_id');
	}

	public function recordType(){
		return $this->belongsTo('Nixzen\RecordType', 'recordtype_id');
	}
}
