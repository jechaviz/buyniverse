<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position', 'department', 'skype', 'facebook', 'twitter', 'personalWebSite', 'employer_id'];
    
}
