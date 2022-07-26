<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['title', 'job_id', 'description', 'due_date', 'priority', 'created_by', 'client_visibility', 'milestone', 'status', 'job_id'];
}
