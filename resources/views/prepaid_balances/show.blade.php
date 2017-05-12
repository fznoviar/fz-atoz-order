@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Prepaid Balance</div> --}}
                <div class="panel-body">
                    <div class="text-center">
                        <p>Your Mobile Phone Number {{ $balance->phone_number }} will be topped up for {{ $balance->amount }} after you pay</p>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <a href="#" class="btn btn-primary btn-block">Pay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection