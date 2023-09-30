@extends('layouts.app')

@section('content')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="card col-md-6">
                    <div class="card-body">
                        <p class="text-center">Staff Login</p>
                        <form method="POST" action="{{ url('/staff/login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="email"  class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" placeholder="username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
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
                                <div class="col-8">
                                    <div>
                                        <label for="remember">
                                            Forgot password? <a href="">Click here to reset.</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@endsection
