<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultContribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendances', 'assignments', 'activities', 'status',
    ];
}
