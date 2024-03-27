<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicClass extends Model {

    protected $table = 'academic_class';
    protected $fillable = [
        'name', 'academic_session_id'
    ];

    use HasFactory;
}
