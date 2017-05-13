<?php

namespace App\Models\Traits;

use App\Models\Order;

trait OrderableTrait
{
    public function order()
    {
        return $this->morphOne(Order::class, 'orderable');
    }

    public function getOrderNumber()
    {
        if ($this->order) {
            return $this->order->order_number;
        }
        return '-';
    }
}
