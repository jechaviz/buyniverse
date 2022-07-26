<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply_ticket extends Model
{
    use HasFactory;
    protected $fillable = ['message', 'user_id', 'ticket_id'];
}
