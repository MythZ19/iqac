<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'department_id',
        'sc_reg_m',
        'sc_reg_f',
        'sc_cont_m',
        'sc_cont_f',
        'st_reg_m',
        'st_reg_f',
        'st_cont_m',
        'st_cont_f',
        'obc_reg_m',
        'obc_reg_f',
        'obc_cont_m',
        'obc_cont_f',
        'gen_reg_m',
        'gen_reg_f',
        'gen_cont_m',
        'gen_reg_f'
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
