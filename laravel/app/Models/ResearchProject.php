<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'project_name',
        'principal_investigator',
        'funding_agency',
        'type',
        'dept',
        'year_of_award',
        'funds_provided',
        'duration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

