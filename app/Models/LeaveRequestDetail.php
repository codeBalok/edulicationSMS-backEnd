<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequestDetail extends Model
{
    use HasFactory;
    protected $table = 'leave_request_detail';
    protected $fillable = [
        'status',
    ];
}
