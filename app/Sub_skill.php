<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_skill extends Model
{
    use HasFactory;
    protected $fillable = ['sub_skill', 'skill_id'];
}
