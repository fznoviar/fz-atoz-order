<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class OrderableRepository extends BaseRepository implements BaseRepositoryInterface
{
    public function create(Request $request, $attributes = [])
    {
        $attributes = array_merge($this->validateInput($request), $attributes);
        $instance = $this->model()->newInstance($attributes);
        $instance->save();
        auth()->user()->orders()->save((new Order())->item()->associate($instance));
        return $instance;
    }
}
