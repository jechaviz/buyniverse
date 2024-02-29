<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatSkill extends Model
{
    use HasFactory;
    protected $fillable = ['cat_id', 'skill_id'];
}
