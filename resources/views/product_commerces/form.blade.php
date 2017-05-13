@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product Commerce</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('product-commerces.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                            <label for="product" class="col-md-4 control-label">Product</label>

                            <div class="col-md-6">
                                <textarea name="product" id="product" class="form-control" rows="5">{{ old('product') }}</textarea>

                                @if ($errors->has('product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('shipping_address') ? ' has-error' : '' }}">
                            <label for="shipping_address" class="col-md-4 control-label">Shipping Address</label>

                            <div class="col-md-6">
                                <textarea name="shipping_address" id="shipping_address" class="form-control" rows="5">{{ old('shipping_address') }}</textarea>

                                @if ($errors->has('shipping_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Value</label>

                            <div class="col-md-6">
                                <input class="form-control" type="number" id="price" name="price" value="{{ old('price') }}">

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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