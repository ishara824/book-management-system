<?php

namespace App\Iface;

interface BookRepositoryInterface
{
    public function findAllBooks();

    public function findBookById($id);

    public function findBookByKeyword($keyword);
}
