<?php

namespace App\Http\Controllers;

use App\Helpers\SessionHelper;
use App\Models\Department;
use App\Models\Roleaccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    private $sesionHelper;

    public function __construct()
    {
        $this->sesionHelper = new SessionHelper();
    }

    public function index()
    {
        return view('login\index');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $Department = Department::find($user->unit);
            $roles = Roleaccount::where('account', $user->id)->select('role')->get();
            $arrRole = array();
            foreach ($roles as $role) {
                array_push($arrRole, $role->role);
            }
            Session::put('role', json_encode($arrRole));
            Session::put('Departmentname', $Department->name);
            Session::put('DepartmentId', $Department->id);
            Session::put('userId', $user->id);
            Session::put('userName', $user->name);

            return response()->json(['msg' => 'ok', 'data' => "Đăng nhập thành công"], Response::HTTP_OK);
        } else {
            return response()->json(['msg' => 'fails', 'data' => 'Sai mật khẩu hoặc tên đăng nhập'], Response::HTTP_OK);
        }
    }

    public function hasRole($role)
    {
        $roles = $this->sesionHelper->getRole();

        if (in_array($role, $roles)) {
            return true;
        } else {
            return false;
        }
    }

    public function home()
    {
        return view('home\index');
    }

    public function resetPassword()
    {
        return Hash::make("123456");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
