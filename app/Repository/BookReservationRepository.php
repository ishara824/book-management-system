<?php

namespace App\Repository;

use App\Iface\BookReservationRepositoryInterface;
use App\Models\BookReservation;

class BookReservationRepository implements BookReservationRepositoryInterface
{
    public function getAssignedBooks()
    {
        $assignedBooks = BookReservation::query()
            ->where('status','=','Assigned')
            ->where('reader_id','=',auth('reader')->user()->id)
            ->get();
        return $assignedBooks;
    }

    public function getReturnedBooks()
    {
        $returnedBooks = BookReservation::query()
            ->where('status','=','Returned')
            ->where('reader_id','=',auth('reader')->user()->id)
            ->get();
        return $returnedBooks;
    }
}
