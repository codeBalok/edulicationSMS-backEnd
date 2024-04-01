<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchooling extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','still_schooling', 'school_level','is_school_completed','school_completion_year'];
}
