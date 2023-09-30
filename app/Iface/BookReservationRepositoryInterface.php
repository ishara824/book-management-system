<?php

namespace App\Iface;

interface BookReservationRepositoryInterface
{
    public function getAssignedBooks();

    public function getReturnedBooks();
}
