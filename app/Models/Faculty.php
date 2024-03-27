<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'shortcode', 'status',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'faculty_id', 'id');
    }
}
