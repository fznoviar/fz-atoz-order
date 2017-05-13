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
                            <h4><b>Total</b></h4>
                            <p>{{ format_currency($commerce->total) }}</p>
                        </div>
                        <p><b>{{ $commerce->product }}</b> that cost <b>{{ format_currency($commerce->price) }}</b> will be shipped to <b>{{ $commerce->shipping_address }}</b> after you pay</p>

                        @include('_partials.success-pay-button', ['order' => $commerce->order])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection