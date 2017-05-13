@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Prepaid Balance</div> --}}
                <div class="panel-body">
                    <div class="text-center">
                        <div>
                            <h4><b>Your Order Number</b></h4>
                            <p>{{ $balance->getOrderNumber() }}</p>
                        </div>
                        <div>
                            <h4><b>Total</b></h4>
                            <p>{{ format_currency($balance->total) }}</p>
                        </div>
                        <p>Your Mobile Phone Number <b>{{ $balance->phone_number }}</b> will be topped up for <b>{{ format_currency($balance->amount) }}</b> after you pay</p>

                        @include('_partials.success-pay-button', ['order' => $balance->order])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection