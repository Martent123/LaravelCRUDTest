<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    //define fillable parameters
    protected $fillable = [
        'program',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
