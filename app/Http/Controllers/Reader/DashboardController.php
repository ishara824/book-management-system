<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use App\Iface\BookReservationRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $guard = 'reader';
    protected $bookReservationRepositoryInterface;

    public function __construct(BookReservationRepositoryInterface $bookReservationRepositoryInterface)
    {
        $this->bookReservationRepositoryInterface = $bookReservationRepositoryInterface;
    }

    public function showDashboard()
    {
        $assignedBooks = $this->bookReservationRepositoryInterface->getAssignedBooks();
        return view('reader.dashboard')->with(['assignedBooks' => $assignedBooks]);
    }

    public function showReturnedBooks()
    {
        $returnedBooks = $this->bookReservationRepositoryInterface->getReturnedBooks();
        return view('reader.borrowedHistory')->with(['returnedBooks' => $returnedBooks]);
    }


}
