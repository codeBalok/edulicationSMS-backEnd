<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model {

    protected $table = 'academic_sessions';
    protected $fillable = [
        'name', 'start_date', 'end_date'
    ];

    use HasFactory;
}
