@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-12">
            <h3>Add User</h3>
        </div>
        <div>
            <form action="{{ url('/staff/save-user') }}" method="post">
                @csrf
                @if(count($errors) > 0)
                    @foreach( $errors->all() as $message )
                        <div class="alert alert-danger display-hide col-md-3">
                            <button class="close" data-close="alert"></button>
                            <span>{{ $message }}</span>
                        </div>
                    @endforeach
                @endif
                <div class="row col-md-6">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="first_name">
                </div>
                <div class="row col-md-6">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="last_name">
                </div>
                <div class="row col-md-6">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="row col-md-6">
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number">
                </div>
                <div class="row col-md-6">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="row col-md-6">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password">
                </div>
                <div class="row col-md-6">
                    <label for="">Roles</label>
                    <select name="role" class="form-control">
                        <option></option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row col-md-6 mt-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
