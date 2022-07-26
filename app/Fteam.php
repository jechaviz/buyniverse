<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fteam extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'role', 'user_id'];
}
