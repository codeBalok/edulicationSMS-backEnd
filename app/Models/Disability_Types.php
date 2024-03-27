<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disability_Types extends Model
{
    use HasFactory;
    protected $table = 'disability_types';
    protected $fillable = [
        'type', 'description','status'
    ];
}
