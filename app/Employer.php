<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'taxId', 'taxPayerType', 'privateKey', 'publicKey', 'privateKeyPassword', 'licence', 'mode', 'user_id'];
}
