<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'start_date', 'status',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'batch_program', 'batch_id', 'program_id');
    }
}
