<?php

namespace App\Repositories;

use App\Models\ProductCommerce;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\OrderableRepository;

class EloquentProductCommerceRepository extends OrderableRepository implements BaseRepositoryInterface
{
    public function __construct(ProductCommerce $model)
    {
        parent::__construct($model);
    }
}
