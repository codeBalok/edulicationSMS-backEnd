<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'faculty_id', 'title', 'slug', 'shortcode', 'registration', 'status',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_program', 'program_id', 'batch_id');
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class, 'program_semester', 'program_id', 'semester_id');
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'program_session', 'program_id', 'session_id');
    }

    public function semesterSections()
    {
        return $this->hasMany(ProgramSemesterSection::class, 'program_id', 'id');
    }
}
