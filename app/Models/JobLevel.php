<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLevel extends Model
{
    use HasFactory;
    protected $table = 'job_levels';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
}
