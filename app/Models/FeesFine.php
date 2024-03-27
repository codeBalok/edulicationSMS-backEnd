<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesFine extends Model {

    protected $table = 'fees_fines';
    protected $fillable = [
        'start_day', 'end_day', 'amount', 'type', 'status',
    ];

    use HasFactory;
    
    public function feesCategories()
    {
        return $this->belongsToMany(FeesCategory::class, 'fees_category_fees_fine', 'fees_fine_id', 'fees_category_id');
    }

}