<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_CANCEL = 2;

    protected $fillable = [
        'order_number',
        'status',
        'paid_time'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->order_number = time();
        });
    }

    public function item()
    {
        return $this->morphTo('orderable');
    }

    public function scopeByUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeUseDefault($query)
    {
        return $query->latest();
    }

    public function scopeOrderNumber($query, $orderNumber)
    {
        return $query->where('order_number', $orderNumber);
    }

    public function scopeSearchOrderNumber($query, $key)
    {
        if (strlen($key) == 10) {
            return $query->orderNumber($key);
        } elseif (strlen($key) < 10) {
            return $query->where('order_number', 'like', "%{$key}%");
        }
        return $query;
    }

    public function isValid()
    {
        return Carbon::now()->lte($this->created_at->addMinutes(5));
    }

    public function isOwn()
    {
        return $this->user_id == auth()->user()->getKey();
    }

    public function isSuccess()
    {
        return $this->status === static::STATUS_SUCCESS;
    }

    public function isPending()
    {
        return $this->status === static::STATUS_PENDING;
    }

    public function isCancel()
    {
        return $this->status === static::STATUS_CANCEL;
    }

    public function pay()
    {
        if ($this->isValid()) {
            $this->item->pay();
            $this->status = static::STATUS_SUCCESS;
            $this->paid_time = Carbon::now();
        } else {
            $this->status = static::STATUS_CANCEL;
        }
    }

    public function cancelOrder()
    {
        $this->update([
            'status' => static::STATUS_CANCEL
        ]);
    }

    /**
     * Check order that still can be pay
     * Technically use scheduler
     *
     * @return  void
     */
    public static function checkValidOrder()
    {
        $pendingOrder = static::byUserId(auth()->user()->getKey())->useDefault()
            ->whereStatus(static::STATUS_PENDING)->get();
        foreach ($pendingOrder as $order) {
            if (!$order->isValid()) {
                $order->cancelOrder();
            }
        }
    }
}
