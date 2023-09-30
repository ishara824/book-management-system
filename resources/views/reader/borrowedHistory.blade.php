
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-12">
            <div class="col-md-4">
                <h3>Borrowed Books</h3>
            </div>
        </div>

        <table class="table table-responsive col-md-12 mt-4">
            <thead class="thead-dark">
            <tr>
                <th width="100">#</th>
                <th class="text-center" width="500">Name</th>
                <th class="text-center" width="100">Category</th>
                <th class="text-center" width="200">Issued Date</th>
                <th class="text-center" width="400">Returned Date</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 1; @endphp
            @foreach($returnedBooks as $returnedBook)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $returnedBook->book->title }}</td>
                    <td>{{ $returnedBook->book->category }}</td>
                    <td>{{ $returnedBook['issued_date'] }}</td>
                    <td>{{ $returnedBook['returned_date'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
