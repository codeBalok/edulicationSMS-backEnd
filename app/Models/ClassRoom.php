<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'floor', 'capacity', 'type', 'description', 'status',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_class_room', 'class_room_id', 'program_id');
    }
}
