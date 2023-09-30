@extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <!-- /.login-logo -->
                <div class="card col-md-6">
                    <div class="card-body">
                        <p class="text-center">Reader Login</p>

                        <form method="POST" action="{{ url('/reader/login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="email"  class="form-control" required autocomplete="username" placeholder="username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" required autocomplete="current-password" placeholder="Password">
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
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember" name="remember"  {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>


                        <!-- /.social-auth-links -->
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    @endsection

