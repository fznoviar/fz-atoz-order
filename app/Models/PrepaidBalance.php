<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrepaidBalance extends BaseModel
{
    protected $fillable = [
        'phone_number',
        'amount',
        'user_id'
    ];

    protected $rules = [
        'phone_number' => 'required|digits_between:7,12|regex:/^(081)/',
        'amount' => 'required|numeric|in:10000,50000,100000',
    ];
}
