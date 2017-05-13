<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Validator;

class PaymentController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        return view('payments.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|exists:orders,order_number',
        ]);
        if ($validator->fails()) {
            return redirect('payment')->withErrors($validator)->withInput();
        }

        $order = $this->order->orderNumber($request->order_number)->first();
        $validator->after(function ($validator) use ($order) {
            if (!$order->isValid()) {
                $validator->errors()->add('order_number', 'Order is cancel or already paid');
                if ($order->isPending()) {
                    $order->cancelOrder();
                }
            } elseif (!$order->isOwn()) {
                $validator->errors()->add('order_number', 'Please input correct order number');
            }
        });

        if ($validator->fails()) {
            return redirect('payment')->withErrors($validator)->withInput();
        }

        $order->pay();
        $order->update([
            'status' => Order::STATUS_SUCCESS
        ]);

        return redirect()->route('orders.index');
    }
}
