<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'language';
    protected $fillable = [
        'name', 'code', 'description', 'direction', 'default', 'status',
    ];

    // Language Version
    static public function version()
    {
        if(Session()->has('locale')){

            $version = Language::where('code', Session()->get('locale'))->first();
        }
        else{
            $version = Language::where('default', 1)->first();
        }

        return $version;
    }
}
