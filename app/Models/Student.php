<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    //define fillable parameters
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone',
        'program',
    ];

}
