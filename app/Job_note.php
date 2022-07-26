<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_note extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'star', 'color', 'user_id', 'job_id'];
}
