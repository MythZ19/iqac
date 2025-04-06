<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionOfTeachingFaculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'designation',
        'degree',
        'university_institute',
        'subject_specialization',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
