<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_id', 'source_id', 'program_id', 'course_id', '0.', 'father_name', 'phone', 'email', 'address', 'purpose', 'note', 'date', 'follow_up_date', 'assigned', 'number_of_students', 'status', 'created_by', 'updated_by',
    ];

    // public function reference()
    // {
    //     return $this->belongsTo(EnquiryReference::class, 'reference_id');
    // }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // public function source()
    // {
    //     return $this->belongsTo(EnquirySource::class, 'source_id');
    // }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function assign()
    {
        return $this->belongsTo('App\User', 'assigned');
    }

    public function recordedBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
