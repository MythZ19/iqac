<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annex3 extends Model
{
    use HasFactory;

    protected $table = 'annex_3';

    protected $fillable = [
        'user_id',
        'name_of_patenter',
        'patent_number',
        'title_of_patent',
        'year',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
