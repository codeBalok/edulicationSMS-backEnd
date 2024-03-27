<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {

    protected $table = 'teacher';
    protected $fillable = [
        'first_name', 'Last_name',
    ];

    use HasFactory;
}
