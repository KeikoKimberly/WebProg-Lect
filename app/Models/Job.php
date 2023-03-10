<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];

    public function jobLevel ()
    {
        return $this->hasOne(JobLevel::class, 'id', 'job_level_id');
    }

    public function company ()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
