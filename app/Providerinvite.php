<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providerinvite extends Model
{
    use HasFactory;
    protected $fillable = ['providers', 'job_id', 'email_text'];
}
