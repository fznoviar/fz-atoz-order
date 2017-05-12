<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCommerce extends BaseModel
{
    protected $fillable = [
        'product',
        'shipping_address',
        'price'
    ];

    protected $rules = [
        'product' => 'required|alpha_dash|min:10|max:150',
        'shipping_address' => 'required|alpha_dash|min:10|max:150',
        'price' => 'required|numeric'
    ];
}
