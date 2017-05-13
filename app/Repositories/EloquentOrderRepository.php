<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;

class EloquentOrderRepository extends BaseRepository implements BaseRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
