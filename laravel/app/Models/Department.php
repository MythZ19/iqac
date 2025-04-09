<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'user_id',
        'name',
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

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
