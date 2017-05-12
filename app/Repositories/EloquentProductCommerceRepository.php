<?php

namespace App\Repositories;

use App\Models\ProductCommerce;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;

class EloquentProductCommerceRepository extends BaseRepository implements BaseRepositoryInterface
{
    public function __construct(ProductCommerce $model)
    {
        parent::__construct($model);
    }
}
