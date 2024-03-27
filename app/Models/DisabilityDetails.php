<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'is_disability', 'area_of_disability','medical_note',
    ];
}
