@extends('layouts.app')

@section('content')
    <div class="container">
        <input type="hidden" id="reader_id">
        <input type="hidden" id="book_id">
        <div class="row col-md-12">
            <h3>Assign Book</h3>
        </div>
        <div class="row col-md-12">
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchParamReader" placeholder="Search Readers (Reader Name)">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" onclick="searchReader()">Search</button>
            </div>
        </div>
        <div class="row col-md-12 mt-2">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="First Name" id="first_name" disabled>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Last Name" id="last_name" disabled>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Email" id="email" disabled>
            </div>
        </div>

        <div class="row col-md-12 mt-5">
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchParamBook" placeholder="Search Books (Book Name)">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" onclick="searchBook()">Search</button>
            </div>
        </div>
        <div class="row col-md-12 mt-2">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Book Name" id="book_name" disabled>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Category" id="category" disabled>
            </div>
        </div>

        <div class="row col-md-12 mt-2">
            <div class="col-md-4">
                <label for="">Due Date</label>
                <input type="date" class="form-control" placeholder="Due Date" id="due_date">
            </div>
        </div>
        <div class="row col-md-12 mt-2">
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" onclick="assignBook()">Assign</button>
            </div>
        </div>
    </div>
@endsection

<script>
    function searchReader()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var searchParam = $('#searchParamReader').val();

        $.ajax({
            url: '/staff/search-reader',
            type: 'post',
            data: {keyword: searchParam},
            dataType: 'json',
            success: function (data) {
                $('#reader_id').val(data.reader[0].id);
                $('#first_name').val(data.reader[0].first_name);
                $('#last_name').val(data.reader[0].last_name);
                $('#email').val(data.reader[0].email);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    async function searchBook()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var searchParam = $('#searchParamBook').val();

        await $.ajax({
            url: '/staff/search-book',
            type: 'post',
            data: {keyword: searchParam},
            dataType: 'json',
            success: function (data) {
                $('#book_id').val(data.book[0].id);
                $('#book_name').val(data.book[0].title);
                $('#category').val(data.book[0].category);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function assignBook()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var readerId = $('#reader_id').val();
        var bookId = $('#book_id').val();
        var dueDate = $('#due_date').val();

        $.ajax({
            url: '/staff/assign-book',
            type: 'post',
            data: {readerId: readerId, bookId: bookId, dueDate: dueDate},
            dataType: 'json',
            success: function (data) {
                console.log(data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

</script>
