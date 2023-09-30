<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Iface\BookRepositoryInterface;
use App\Iface\UserRepositoryInterface;
use App\Jobs\BorrowEmailJob;
use App\Models\Book;
use App\Models\BookReservation;
use App\Models\BookStock;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    protected $guard = 'staff';
    private $bookRepositoryInterface;
    private $userRepositoryInterface;

    public function __construct(BookRepositoryInterface $bookRepositoryInterface, UserRepositoryInterface $userRepositoryInterface)
    {
        $this->bookRepositoryInterface = $bookRepositoryInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function showDashboard()
    {
        $books = $this->bookRepositoryInterface->findAllBooks();
        return view('staff.dashboard')->with(['books' => $books]);
    }

    public function getAllBooks()
    {
        $books = $this->bookRepositoryInterface->findAllBooks();
        return array(['books' => $books]);
    }

    public function viewBook($id)
    {
        $book = $this->bookRepositoryInterface->findBookById($id);
        return response()->json(['code' => 200, 'book' => $book]);
    }

    public function addBookForm()
    {
        return view('staff.addBook');
    }

    public function saveBook(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'isbn' => 'required',
            'category' => 'required',
            'edition' => 'required',
            'image' => 'required',
            'total_stock' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }

        try {
            $book = new Book();
            $book->title = $request->title;
            $book->isbn = $request->isbn;
            $book->category = $request->category;
            $book->edition = $request->edition;

            $imageName = "watermark.png";

            if ($request->image != null) {
                $imageName = $request->title . '-' . time() . '.' . $request->image->getClientOriginalExtension();
            }

            if ($request->image != null) {
                $request->image->move(public_path('books-image'), $imageName);
            }
            $book->image = $imageName;
            $book->save();

            $stock = new BookStock();
            $stock->book_id = $book->id;
            $stock->quantity = $request->total_stock;
            $stock->save();

            return redirect()->route('staff.dashboard');
        } catch (\Exception $exception) {

        }

    }

    public function editBookForm($bookId)
    {
        $book = $this->bookRepositoryInterface->findBookById($bookId);
        if ($book) {
            return view('staff.editBook')->with(['book' => $book]);
        }
    }

    public function editBook(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'isbn' => 'required',
            'category' => 'required',
            'edition' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->with(['errors' => $validator->errors()]);
        }

        try {

            $book = $this->bookRepositoryInterface->findBookById($request->bookId);
            if ($book) {
                $book->title = $request->title;
                $book->isbn = $request->isbn;
                $book->category = $request->category;
                $book->edition = $request->edition;

                $imageName = "watermark.png";

                if ($request->image != null) {
                    $imageName = $request->title . '-' . time() . '.' . $request->image->getClientOriginalExtension();
                }

                if ($request->image != null) {
                    $request->image->move(public_path('books-image'), $imageName);
                }
                $book->image = $imageName;
                $book->save();

                return redirect()->route('staff.dashboard');
            }

        } catch (\Exception $exception) {

        }
    }

    public function deleteBook(Request $request)
    {
        $book = $this->bookRepositoryInterface->findBookById($request->bookId);
        if ($book) {
            $book->delete();
            return response()->json(['code' => 200]);
        }
    }

    public function borrowBookForm()
    {
        return view('staff.assignBook');
    }

    public function searchReader(Request $request)
    {
        $reader = $this->userRepositoryInterface->findReaderByKeyword($request->keyword);
        return response()->json(['reader' => $reader]);
    }

    public function searchBook(Request $request)
    {
        $book = $this->bookRepositoryInterface->findBookByKeyword($request->keyword);
        return response()->json(['book' => $book]);
    }

    public function assignBook(Request $request)
    {
        $book_reservation = new BookReservation();
        $book_reservation->reader_id = $request->readerId;
        $book_reservation->book_id = $request->bookId;
        $book_reservation->staff_id = auth('staff')->user()->id;

        $stock = BookStock::where('book_id', $request->bookId)->first();

        $book_reservation->stock_id = !is_null($stock) ? $stock->id : 0;
        $book_reservation->issued_date = date("Y-m-d");
        $book_reservation->due_date = $request->dueDate;
        $book_reservation->status = "Assigned";
        $book_reservation->save();

        $existingQty = $stock->quantity;
        $stock->quantity = $existingQty - 1;
        $stock->save();

        $reader = Reader::query()->find($request->readerId);
        $book = Book::query()->find($request->bookId);

        $emailData = [
            'reader_email' => $reader->email,
            'reader_name' => !is_null($reader) ? $reader->first_name : '',
            'book_name' => !is_null($book) ? $book->title : '',
            'due_date' => $request->dueDate
        ];

        BorrowEmailJob::dispatch($emailData);

        return redirect()->back();

    }

}
