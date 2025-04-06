<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestLecturerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'research_degrees',
        'subject_specialization',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
