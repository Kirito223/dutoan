<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('login\index');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $Department = Department::find($user->unit);
            Session::put('Departmentname', $Department->name);
            Session::put('DepartmentId', $Department->id);
            Session::put('userId', $user->id);
            return response()->json(['msg' => 'ok', 'data' => "Đăng nhập thành công"], Response::HTTP_OK);
        } else {
            return response()->json(['msg' => 'fails', 'data' => 'Sai mật khẩu hoặc tên đăng nhập'], Response::HTTP_OK);
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
