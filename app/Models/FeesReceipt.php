<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesReceipt extends Model {

    protected $table = 'fees_receipt';
    protected $fillable = [
        'slug', 'title', 'header_left', 'header_center', 'header_right', 'body', 'footer_left', 'footer_center', 'footer_right', 'logo_left', 'logo_right', 'background', 'width', 'height', 'student_photo', 'barcode', 'status',
    ];

    use HasFactory;
    



}