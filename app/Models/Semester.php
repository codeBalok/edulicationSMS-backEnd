<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'year', 'status',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_semester', 'semester_id', 'program_id');
    }

}
