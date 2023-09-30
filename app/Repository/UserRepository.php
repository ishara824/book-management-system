<?php

namespace App\Repository;

use App\Iface\UserRepositoryInterface;
use App\Models\Reader;
use App\Models\StaffUser;

class UserRepository implements UserRepositoryInterface
{
    public function findAllUsers()
    {
        $staffUsers = StaffUser::query()->get();
        $readers = Reader::query()->get();

        return array(['staffUsers' => $staffUsers, 'readers' => $readers]);
    }

    public function findReaderById($id)
    {
        $reader = Reader::query()->find($id);
        return $reader;
    }

    public function findStaffUserById($id)
    {
        $staffUser = StaffUser::query()->find($id);
        return $staffUser;
    }

    public function findReaderByKeyword($keyword)
    {
        $reader = Reader::query()
            ->where('first_name','LIKE','%' . $keyword . '%')
            ->orWhere('last_name','LIKE','%' . $keyword . '%')
            ->limit(1)
            ->get();
        return $reader;
    }
}
