<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffHourlyAttendance extends Model {

    protected $table = 'staff_hourly_attendances';
    protected $fillable = [
        'employ_id', 'subject_id', 'session_id', 'program_id', 'semester_id', 'section_id', 'start_time', 'end_time', 'date', 'attendance', 'note', 'created_by', 'updated_by',
    ];

    use HasFactory;
    
    public function Employ()
    {
        return $this->belongsTo('App\Models\Employee', 'employ_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

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
}