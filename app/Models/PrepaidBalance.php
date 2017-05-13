<?php

namespace App\Models;

use App\Models\Traits\OrderableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PrepaidBalance extends BaseModel
{
    use OrderableTrait;

    const STATUS_PENDING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 2;

    protected $fillable = [
        'phone_number',
        'amount',
        'status'
    ];

    protected $rules = [
        'phone_number' => 'required|digits_between:7,12|regex:/^(081)/',
        'amount' => 'required|numeric|in:10000,50000,100000',
    ];

    protected $appends = [
        'total'
    ];

    public function getTotalAttribute()
    {
        return $this->amount + ($this->amount * 0.05);
    }

    public function pay()
    {
        if ($this->isSuccessTopup()) {
            $this->status = static::STATUS_SUCCESS;
        } else {
            $this->status = static::STATUS_FAIL;
        }
        $this->save();
    }

    protected function isSuccessTopup()
    {
        if (is_daylight()) {
            return rand_success_rate(90);
        }
        return rand_success_rate(40);
    }
}
