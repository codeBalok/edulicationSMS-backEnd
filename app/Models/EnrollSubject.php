<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id', 'semester_id', 'section_id', 'status',
    ];


    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'enroll_subject_subject', 'enroll_subject_id', 'subject_id');
    }
}
