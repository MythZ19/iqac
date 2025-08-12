<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolDetails extends Model
{
    protected $fillable = [
        'user_id',
        'name_of_school',
        'name_of_department',
        'year_of_establishment',
        'year_of_first_intake',
        'head_of_department',
        'department_phone',
        'residence_phone',
        'email',
        'department_fax',
        'brief_introduction',
        'number_of_visiting_fellows',
        'student_intake_capacity',
        'number_of_patents_received',
    ];
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
