<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolContactPerson extends Model {

    protected $table = 'school_contact_person';
    protected $fillable = [
        'first_name', 'Last_name',
    ];

    use HasFactory;
}
