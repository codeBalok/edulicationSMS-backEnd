<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageDiversity extends Model
{
    use HasFactory;

    protected $fillable = [
        'birth_country', 'main_english', 'other_language', 'other_language_name', 'eng_proficiency', 'indigenous_status',
    ];

}
