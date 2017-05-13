@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Hello, {{ auth()->user()->name }}</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <a class="btn btn-primary" href="{{ route('prepaid-balances.create') }}">Need a Prepaid Balance?</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a class="btn btn-primary" href="{{ route('product-commerces.create') }}">Want to buy something?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
