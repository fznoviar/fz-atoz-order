<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\EloquentOrderRepository as Repository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    public function index()
    {
        Order::checkValidOrder();
        $scopes = ['byUserId' => auth()->user()->getKey()];
        if (request()->has('q')) {
            $scopes['searchOrderNumber'] = request()->get('q');
        }
        $orders = $this->repository->paginate(20, $scopes);
        $orders->load('item');
        return view('orders.index', compact('orders'));
    }
}
