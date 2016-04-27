<?php

namespace Nixzen\Models;

use Illuminate\Database\Eloquent\Model;

class StatePosition extends Model
{
    protected $table = 'state_positions';

	protected $fillable = ['pos_x', 'pos_y'];
}
