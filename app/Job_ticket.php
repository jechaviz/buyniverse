<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_ticket extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'message', 'sent_to', 'from', 'priority', 'status', 'job_id'];
}
