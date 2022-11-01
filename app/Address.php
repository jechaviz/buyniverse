<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'street', 'externalNumber', 'internalNumber', 'neighborhood', 'locality', 'reference', 'city', 'state', 'country', 'zipCode', 'latitude', 'longitude', 'website', 'employer_id'];
}
