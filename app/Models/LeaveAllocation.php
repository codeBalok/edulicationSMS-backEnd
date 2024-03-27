<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAllocation extends Model
{
    use HasFactory;

    protected $table = 'leave_allocation';
    protected $fillable = [
        'start_date', 'end_date', 'description',
    ];
}
