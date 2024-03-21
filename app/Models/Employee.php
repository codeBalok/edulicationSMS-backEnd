<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   
  
    protected $table = 'employee';
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'contact_number', 'email', 'address', 'profile_photo', 'joining_date', 'birthdate', 'salary', 'employee_code', 'employee_status', 'department_id', 'designation_id',
    ];
    public $timestamps = true;

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo('App\Models\Designation', 'designation_id');
    }

    public function roles()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
        public function workShift()
    {
        return $this->belongsTo('App\Models\WorkShiftType', 'work_shift', 'id');
    }
        public function classes()
    {
        return $this->hasMany('App\Models\ClassRoutine', 'teacher_id', 'id');
    }
    public function notes()
    {
        return $this->morphMany('App\Models\StaffNote', 'noteable');
    }
    
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
