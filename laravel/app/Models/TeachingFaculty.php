<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class TeachingFaculty extends Model
{
    use HasFactory; // 

    protected $fillable = [
        'user_id',
        'department_id',
        'name',
        'designation',
        'degree_university_institution', 
        'subject_specialization',
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
