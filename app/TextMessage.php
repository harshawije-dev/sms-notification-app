<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextMessage extends Model
{

    protected $table = "users_phone_number";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phoneNumber',
    ];
    
}
