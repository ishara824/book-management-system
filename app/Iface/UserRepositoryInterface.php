<?php

namespace App\Iface;

interface UserRepositoryInterface
{
    public function findAllUsers();

    public function findReaderById($id);

    public function findStaffUserById($id);

    public function findReaderByKeyword($keyword);
}
