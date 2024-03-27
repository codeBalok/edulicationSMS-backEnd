<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveAllocationDetail extends Model
{
    use HasFactory;

    protected $table = 'leave_allocation_detail';
    protected $fillable = [
        'alloted_leave', 'used_leave', 
    ];
}
