<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyContactStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_type', 
    ];

}
