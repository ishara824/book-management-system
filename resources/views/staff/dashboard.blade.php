@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row col-md-12">
            <div class="col-md-4"></div>
            @role('admin', 'staff')
            <div class="col-md-8 text-right">
                <a class="btn btn-primary" href="{{ route('add.book.ui') }}">Add Book+</a>
            </div>
            @endrole
        </div>

        <table class="table table-responsive col-md-12 mt-4">
            <thead class="thead-dark">
            <tr>
                <th width="100">#</th>
                <th class="text-center" width="500">Title</th>
                <th class="text-center" width="100">Category</th>
                <th class="text-center" width="200">Created At</th>
                <th class="text-center" width="400">Action</th>
            </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($books as $book)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->category }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td class="text-center">
                            @role(['admin','editor','viewer'], 'staff')
                            <button type="button" class="btn btn-primary" onclick="viewBook({{ $book->id }})">View</button>
                            @endrole
                            @role(['admin','editor'], 'staff')
                            <a class="btn btn-secondary" href="{{ route('edit.book.ui', $book->id) }}">Edit</a>
                            @endrole
                            @role('admin', 'staff')
                            <button type="button" class="btn btn-danger" onclick="deleteBook({{ $book->id }})">Delete</button>
                            @endrole
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{--  Modal  --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Book Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">ISBN:</label>
                            <input type="text" class="form-control" id="isbn">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Category:</label>
                            <input type="text" class="form-control" id="category">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Edition:</label>
                            <input type="text" class="form-control" id="edition">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Total Stock:</label>
                            <input type="text" class="form-control" id="total_stock">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Image:</label>
                            <img id="book_image" width="100" height="100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--  End Modal  --}}
@endsection

<script>
    function deleteBook(bookId)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/staff/delete-book',
            type: 'post',
            data: {bookId: bookId},
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    swal("Good job!", "You deleted the book!", "success");
                    setTimeout(function (){
                        location.reload();
                    },1000);
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function viewBook(bookId)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/staff/view-book/' + bookId,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.code === 200) {
                    var imageUrl = '{{ asset("books-image") }}/' + data.book.image;
                    $('#title').val(data.book.title);
                    $('#isbn').val(data.book.isbn);
                    $('#category').val(data.book.category);
                    $('#edition').val(data.book.edition);
                    $('#total_stock').val(data.book.stock.quantity);
                    $('#book_image').attr('src',imageUrl);
                    $('#exampleModal').modal('show');
                }
            },
            error: function (error) {
                console.error(error);
            }
        });

    }


</script>
