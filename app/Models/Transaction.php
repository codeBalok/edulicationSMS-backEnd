<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $table = 'transactions';
    protected $fillable = [
        'transactionable_id', 'transactionable_type', 'transaction_id', 'amount', 'type', 'created_by', 'updated_by',
    ];

    use HasFactory;
    
    // Polymorphic relations
    public function transactionable()
    {
        return $this->morphTo();
    }

}