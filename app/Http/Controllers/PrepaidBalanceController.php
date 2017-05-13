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
        $this->middleware('auth');
        $this->repository = $repository;
        view()->share('amounts', $this->repository->amounts());
    }

    public function create()
    {
        return view('prepaid_balances.form');
    }

    public function store(Request $request)
    {
        $balance = $this->repository->create($request);

        return redirect()->route('prepaid-balances.show', $balance);
    }

    public function show($key)
    {
        $balance = $this->repository->getItem($key);

        $this->authorize('view', $balance);
        return view('prepaid_balances.show', compact('balance'));
    }
}
