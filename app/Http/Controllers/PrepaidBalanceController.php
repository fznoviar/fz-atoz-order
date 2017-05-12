<?php

namespace App\Http\Controllers;

use App\PrepaidBalance;
use Illuminate\Http\Request;
use App\Repositories\EloquentPrepaidBalanceRepository as Repository;

class PrepaidBalanceController extends Controller
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        view()->share('amounts', $this->repository->amounts());
    }

    public function create()
    {
        return view('prepaid_balances.form');
    }

    public function store(Request $request)
    {
        $balance = $this->repository->create($request, ['user_id' => auth()->user()->getKey()]);

        return redirect()->route('prepaid-balances.show', $balance);
    }

    public function show($key)
    {
        $balance = $this->repository->getItem($key);
        return view('prepaid_balances.show', compact('balance'));
    }
}
