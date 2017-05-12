<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $rules = [];

    public function rules()
    {
        return $this->rules;
    }
}
