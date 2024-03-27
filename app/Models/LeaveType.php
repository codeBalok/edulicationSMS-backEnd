<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'limit', 'description', 'status',
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'type_id', 'id');
    }
    
}
