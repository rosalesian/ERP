<?php namespace Nixzen;

use Illuminate\Database\Eloquent\Model;
use Nixzen\User;

class TransactionWorkflow extends Model {

	public function scopeApprover($query, User $user){
		return $query->where('approver', '=', $user->activeRole())
					->where('division', '=', $user->division)
					->where('approved', '=', false)
					->sortBy('priority')
					->first();
	}
}