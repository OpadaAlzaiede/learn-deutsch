<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['issue_title', 'suggested_solution', 'date', 'user_id', 'issueable_type', 'issueable_id'];
}
