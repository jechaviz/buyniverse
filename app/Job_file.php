<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_file extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'size', 'use', 'status', 'user_id', 'job_id'];
}
