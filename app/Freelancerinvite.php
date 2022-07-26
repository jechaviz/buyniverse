<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancerinvite extends Model
{
    use HasFactory;
    protected $fillable = ['freelancers', 'job_id', 'email_text'];
}
