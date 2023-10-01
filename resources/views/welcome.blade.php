@extends('layouts.app')

@section('content')
    <div class="container" id="background-image">
        <div class="row">
            <div class="col-md-12 text-center mt-2">
                <h2 style="color: white">Book Store</h2>
            </div>
        </div>
        <div class="row col-md-12 mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Readers Login</h3>
                        <a class="btn btn-primary" href="{{ url('/reader/login') }}">Login</a>
                        <p>Don't have an account?</p><a href="{{ url('/reader/register') }}">Click Here</a> to register.
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="height: 178px">
                    <div class="card-body text-center">
                        <h3>Staff Login</h3>
                        <a class="btn btn-primary" href="{{ url('/staff/login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
