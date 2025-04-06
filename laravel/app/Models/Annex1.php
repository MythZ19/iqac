<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annex1 extends Model
{
    use HasFactory;

    protected $table = 'annex_1';

    protected $fillable = [
        'user_id',
        'program_name',
        'venue',
        'date',
        'session_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
