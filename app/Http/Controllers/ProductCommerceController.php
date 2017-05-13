<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EloquentProductCommerceRepository as Repository;

class ProductCommerceController extends Controller
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function create()
    {
        return view('product_commerces.form');
    }

    public function store(Request $request)
    {
        $commerce = $this->repository->create($request);

        return redirect()->route('product-commerces.show', $commerce);
    }

    public function show($key)
    {
        $commerce = $this->repository->getItem($key);

        $this->authorize('view', $commerce);
        return view('product_commerces.show', compact('commerce'));
    }
}
