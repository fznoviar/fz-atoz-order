<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface BaseRepositoryInterface
{
    public function model();

    public function getAll($scopes);

    public function paginate($perPage, $scopes);

    public function getItem($key, $attribute);

    public function resolveFillable(Request $request);

    public function validateInput(Request $request);

    public function create(Request $request, $attributes);

    public function update($key, Request $request, $attributes);

    public function delete($key);
}
