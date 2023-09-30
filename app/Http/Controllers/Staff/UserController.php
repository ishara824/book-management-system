<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Iface\UserRepositoryInterface;
use App\Models\StaffUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $guard = 'staff';
    protected $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->middleware('role:admin', ['only' => ['showUserList']]);
    }

    public function showUserList()
    {
        $users = $this->userRepositoryInterface->findAllUsers();
        return view('staff.userList')->with(['users' => $users]);
    }

    public function activateReader(Request $request)
    {
        $reader = $this->userRepositoryInterface->findReaderById($request->readerId);
        if ($reader) {
            $reader->status = 1;
            $reader->save();

            return response()->json(['code' => 200]);
        }
    }

    public function disableReader(Request $request)
    {
        $reader = $this->userRepositoryInterface->findReaderById($request->readerId);
        if ($reader) {
            $reader->status = 0;
            $reader->save();

            return response()->json(['code' => 200]);
        }
    }

    public function activateStaffUser(Request $request)
    {
        $staffUser = $this->userRepositoryInterface->findStaffUserById($request->staffId);
        if ($staffUser) {
            $staffUser->status = 1;
            $staffUser->save();

            return response()->json(['code' => 200]);
        }
    }

    public function disableStaffUser(Request $request)
    {
        $staffUser = $this->userRepositoryInterface->findStaffUserById($request->staffId);
        if ($staffUser) {
            $staffUser->status = 0;
            $staffUser->save();

            return response()->json(['code' => 200]);
        }
    }

    public function showUserRegistrationForm()
    {
        $roles = Role::all();
        return view('staff.addUser')->with(['roles' => $roles]);
    }

    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'first_name' => 'required',
           'last_name' => 'required',
           'email' => 'required',
           'phone_number' => 'required',
           'password' => 'required',
           'confirm_password' => 'required',
           'role' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }

        try {

            $staffUser = new StaffUser();
            $staffUser->first_name = $request->first_name;
            $staffUser->last_name = $request->last_name;
            $staffUser->email = $request->email;
            $staffUser->phone_number = $request->phone_number;
            $staffUser->password = bcrypt($request->password);
            $staffUser->save();

            if ($request->role == 'admin') {
                $staffUser->assignRole('admin');
            } elseif ($request->role == 'editor') {
                $staffUser->assignRole('editor');
            } elseif ($request->role == 'viewer') {
                $staffUser->assignRole('viewer');
            }

            return redirect()->route('list.user.ui');

        } catch (\Exception $exception) {
            Log::error('saveUserError', [$exception->getMessage()]);
        }
    }

}
