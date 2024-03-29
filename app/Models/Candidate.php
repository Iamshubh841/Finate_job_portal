<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'job_candidates';
    protected $fillable = [
        'user_id',
        'shortlisted',
        'name',
        'designation',
        'location',
        'contact_number',
        'user_profile',
        'age',
        'gender',
        'experience',
        'description',
    ];


        public function details()
    {
        return $this->hasOne(CandidateDetail::class, 'user_id', 'user_id');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_candidates', 'user_id', 'job_id');
    }
}
