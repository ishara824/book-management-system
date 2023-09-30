<?php

namespace Database\Seeders;

use App\Models\StaffUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = new StaffUser();
        $staff->first_name = "Super";
        $staff->last_name = "Admin";
        $staff->phone_number = "1234567890";
        $staff->email = "sadmin123@test.com";
        $staff->password = bcrypt("123");
        $staff->save();

        $staff->assignRole('admin');
    }
}
