<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class WorkflowSetup extends Model
{
    protected $table = 'workflow_setup';

		public function states()
		{
			return $this->hasMany(WorkflowState::class, 'workflow_id');
		}
}
