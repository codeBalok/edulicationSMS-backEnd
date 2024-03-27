<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdCardSetting extends Model {

    protected $table = 'id_card_settings';
    protected $fillable = [
        'slug', 'title', 'subtitle', 'logo', 'background', 'website_url', 'validity', 'address', 'student_photo', 'signature', 'barcode', 'status',
    ];

    use HasFactory;
    


}