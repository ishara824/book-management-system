<?php

namespace App\Repository;

use App\Iface\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookRepository implements BookRepositoryInterface
{
    public function findAllBooks()
    {
        return Book::query()->get();
    }

    public function findBookById($id)
    {
        return Book::query()->find($id);
    }

    public function findBookByKeyword($keyword)
    {
        $book = Book::query()
            ->where('title','LIKE','%' . $keyword . '%')
            ->limit(1)
            ->get();
        return $book;
    }

}
