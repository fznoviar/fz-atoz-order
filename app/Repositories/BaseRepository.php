<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function getAll($scopes = [])
    {
        $builder = $this->model()->newQuery();

        if (is_array($scopes) && !empty($scopes)) {
            $builder->scopes($scopes);
        }

        if (method_exists($this->model(), "scopeUseDefault")) {
            $builder = $builder->useDefault();
        }
        return $builder->get();
    }

    public function paginate($perPage = 20, $scopes = [])
    {
        $builder = $this->model()->newQuery();

        if (is_array($scopes) && !empty($scopes)) {
            $builder->scopes($scopes);
        }

        if (method_exists($this->model(), "scopeUseDefault")) {
            $builder = $builder->useDefault();
        }
        return $builder->paginate($perPage);
    }

    public function getItem($key, $attribute = null)
    {
        if ($key instanceof Model) {
            return $key;
        }

        if ($attribute) {
            $model = $this->model()->where($attribute, $key)->first();
            if ($model === null) {
                throw (new ModelNotFoundException)->setModel(
                    get_class($this->model),
                    $key
                );
            }
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

    protected function getRules()
    {
        if (method_exists($this->model(), 'rules')) {
            return $this->model()->rules();
        }
        return [];
    }
}
