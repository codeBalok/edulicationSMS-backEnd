<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table = 'students';
    protected $fillable = [
        
            'entry_date',
            'first_name',
            'middle_name',
            'last_name',
            'mobile_no',
            'business_phone',
            'home_phone',
            'email_id',
        ];
    

    use HasFactory;

    public function statuses()
    {
        return $this->belongsToMany(StatusType::class, 'status_type_student', 'student_id', 'status_type_id');
    }
    
        public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
    
    // Get Current Enroll
    public static function enroll($id)
    {
        $enroll = StudentEnroll::where('student_id', $id)
                                ->where('status', '1')
                                ->orderBy('id', 'desc')
                                ->first();

        return $enroll;
    }
}
