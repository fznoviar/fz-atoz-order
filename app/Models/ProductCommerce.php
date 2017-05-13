<?php

namespace App\Models;

use App\Models\Traits\OrderableTrait;
use Illuminate\Database\Eloquent\Model;

class ProductCommerce extends BaseModel
{
    use OrderableTrait;

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

    protected $appends = [
        'total'
    ];

    public function getTotalAttribute()
    {
        return $this->price + 10000;
    }

    public function pay()
    {
        $this->shipping_code = rand_code('letter', 8);
        $this->save();
    }
}
