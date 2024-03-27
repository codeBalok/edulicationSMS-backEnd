<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'seat', 'status',
    ];

    public function semesterPrograms()
    {
        return $this->hasMany(ProgramSemesterSection::class, 'section_id', 'id');
    }

    public function programSemesters()
    {
        return $this->hasMany(ProgramSemesterSection::class, 'section_id', 'id');
    }
}
