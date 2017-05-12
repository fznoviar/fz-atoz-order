<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

abstract class BaseRepository
{
    use ValidatesRequests;
    
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function model()
    {
        return $this->model;
    }

    public function resolveFillable(Request $request)
    {
        $fillable = $this->model()->getFillable();
        $input = $request->all();

        return array_only($input, $fillable);
    }

    public function validateInput(Request $request)
    {
        $input = $this->resolveFillable($request);
        if (method_exists($this->model(), 'rules')) {
            $validator = $this->getValidationFactory()->make($input, $this->getRules());
            if ($validator->fails()) {
                $this->throwValidationException($request, $validator);
            }
        }
        return $input;
    }

    public function getAll()
    {
        if (method_exists($this->model(), "scopeUseDefault")) {
            return $this->model()->useDefault()->get();
        }
        return $this->model()->get();
    }

    public function getItem($key)
    {
        if ($key instanceof PrepaidBalance) {
            return $key;
        }
        return $this->model()->findOrFail($key);
    }

    public function create(Request $request, $attributes = [])
    {
        $attributes = array_merge($this->validateInput($request), $attributes);
        $instance = $this->model()->newInstance($attributes);
        $instance->save();
        return $instance;
    }

    public function update($key, Request $request, $attributes = [])
    {
        $item = $this->getItem($key);
        $attributes = array_merge($this->validateInput($request), $attributes);
        $item->update($attributes);
        return $item;
    }

    public function delete($key)
    {
        $item = $this->getItem($key);
        $item->delete();
        return $item;
    }

    protected function getRules()
    {
        if (method_exists($this->model(), 'rules')) {
            return $this->model()->rules();
        }
        return [];
    }
}
