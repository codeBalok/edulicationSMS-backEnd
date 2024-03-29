<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentType extends Model {

    protected $table = 'content_type';
    protected $fillable = [
        'title'
    ];

    use HasFactory;
}
