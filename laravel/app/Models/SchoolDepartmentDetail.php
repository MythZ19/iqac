<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDepartmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_name',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
