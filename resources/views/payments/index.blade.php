@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payment</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('payments.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('order_number') ? ' has-error' : '' }}">
                            <label for="order_number" class="col-md-4 control-label">Order Number</label>

                            <div class="col-md-6">
                                <input id="order_number" type="text" class="form-control" name="order_number" value="{{ request()->has('order_number') ? request()->get('order_number') : old('order_number') }}" required autofocus>

                                @if ($errors->has('order_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Pay
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection