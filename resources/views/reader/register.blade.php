@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-6">
                <div class="card-body">
                    <p class="text-center">Reader Registration</p>
                    <form method="POST" action="{{ url('/reader/register') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="first_name"  class="form-control" placeholder="Your First Name">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="last_name"  class="form-control" placeholder="Your Last Name">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="phone_number"  class="form-control" placeholder="Your Phone Number">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="email"  class="form-control" placeholder="Your Email">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Your Password">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Re-type Password">
                        </div>
                        @if(count($errors) > 0)
                            @foreach( $errors->all() as $message )
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    <span>{{ $message }}</span>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
