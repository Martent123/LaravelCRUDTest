<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';

    // using unique_id as primary key
    protected $primaryKey = 'unique_id';
    //define fillable parameters
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone',
        'program_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
