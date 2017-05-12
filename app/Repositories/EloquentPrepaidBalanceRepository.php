<?php

namespace App\Repositories;

use App\Models\PrepaidBalance;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterface;

class EloquentPrepaidBalanceRepository extends BaseRepository implements BaseRepositoryInterface
{
    public function __construct(PrepaidBalance $model)
    {
        parent::__construct($model);
    }

    public function amounts()
    {
        return [
            10000,
            50000,
            100000
        ];
    }
}
