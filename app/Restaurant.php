<?php

namespace App\Restaurant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'restaurant_code',
        'restaurant_desc'
        
    ];
}
