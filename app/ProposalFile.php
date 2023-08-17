<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalFile extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'file', 'description', 'size', 'proposal_id'];
}
