@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row col-md-12">
            <h3>Add Book</h3>
        </div>
        <div>
            <form action="{{ url('/staff/add-book') }}" method="post" enctype="multipart/form-data">
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
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="row col-md-6">
                    <label for="">ISBN</label>
                    <input type="text" class="form-control" name="isbn">
                </div>
                <div class="row col-md-6">
                    <label for="">Category</label>
                    <input type="text" class="form-control" name="category">
                </div>
                <div class="row col-md-6">
                    <label for="">Edition</label>
                    <input type="text" class="form-control" name="edition">
                </div>
                <div class="row col-md-6">
                    <label>Total Stock</label>
                    <input type="text" class="form-control" name="total_stock">
                </div>
                <div class="row col-md-6">
                    <label for="">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="row col-md-6 mt-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
