<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;

    //define fillable parameters
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone',
        'program_id',
        'created_by',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class)
    }

}
