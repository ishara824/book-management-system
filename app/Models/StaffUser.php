<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class StaffUser extends Model implements Authenticatable
{
    use HasFactory;
    use \Illuminate\Auth\Authenticatable;
    use HasRoles;

    protected $table = 'staff_users';
    protected $guard = 'staff';

//    protected function getDefaultGuardName(): string
//    {
//        return 'staff';
//    }

}
