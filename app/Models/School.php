<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model {

    protected $table = 'school';
    protected $fillable = [
        'name', 'address',
    ];

    use HasFactory;
}
