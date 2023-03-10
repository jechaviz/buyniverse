<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'job_id', 'lname', 'role', 'permission', 'notes'];
}
