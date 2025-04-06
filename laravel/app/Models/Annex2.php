<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annex2 extends Model
{
    use HasFactory;

    protected $table = 'annex_2';

    protected $fillable = [
        'user_id',
        'title_of_paper',
        'author_names',
        'department',
        'journal_name',
        'year_of_publication',
        'issn_number',
        'ugc_recognition_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
