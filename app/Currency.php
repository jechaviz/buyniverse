<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'numeric_code', 'code', 'name', 'symbol', 'fraction_name', 'decimals'
    ];
}
