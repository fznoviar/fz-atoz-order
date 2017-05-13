@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-7" style="margin-bottom: 30px;">
            <form action="order" method="GET">
                <input class="form-control" type="text" name="q" onsubmi="submit()" placeholder="Search order number here...">
            </form>
        </div>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Prepaid Balance</div> --}}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <span>Order No.</span>
                        </div>
                        <div class="col-md-4">
                            <span>Description</span>
                        </div>
                        <div class="col-md-2">
                            <span>Total</span>
                        </div>
                        <div class="col-md-3">
                            <span>Information</span>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($orders as $order)
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <span>{{ $order->order_number }}</span>
                        </div>
                        <div class="col-md-4">
                            @if ($order->orderable instanceof App\Models\PrepaidBalance)
                                <span>{{ $order->orderable->amount }} for {{ $order->orderable->phone_number }}</span>
                            @elseif ($order->orderable instanceof App\Models\ProductCommerce)
                                <span>{{ $order->orderable->product }} that cost {{ $order->orderable->price }}</span>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <span>{{ $order->orderable->total }}</span>
                        </div>
                        <div class="col-md-3">
                            @include("orders.info-{$order->status}")
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="text-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection