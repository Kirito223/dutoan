<?php

namespace App\Http\Controllers;

use App\Helpers\SessionHelper;
use App\Models\Account;
use App\Models\Roleaccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    private $sessionHelper;
    public function __construct()
    {
        $this->sessionHelper = new SessionHelper();
    }
    public function index($id)
    {
        return view('account\index', ['id' => $id]);
    }

    public function all($id)
    {
        $list = Account::where('unit', '=', $id)
            ->with('roleaccount')
            ->paginate(20);
        return response()->json($list);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'username' => 'required',
                    'password' => 'required|max:10|min:6',
                    'department' => 'required',
                    'name' => 'required',
                    'role' => 'required|json'
                ],
                [
                    'required' => 'Trường bắt buộc không được để trống',
                    'min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                    'max' => 'Mật khẩu không được quá 10 ký tự'
                ],
                [
                    'username' => 'Tên đăng nhập',
                    'password' => 'Mật khẩu',
                    'department' => "Đơn vị hành chính",
                    'name' => 'Tên',
                    'role' => 'Quyền'
                ]
            );

            if ($validate->fails()) {
                return response()->json(['msg' => 'fail', 'data' => $validate->errors()], Response::HTTP_OK);
            }

            $check = Account::where('username', $request->username)->first();
            if ($check == null) {
                $account = new Account();
                $account->username = $request->username;
                $account->password = Hash::make($request->password);
                $account->unit = $request->department;
                $account->name = $request->name;
                if ($account->save()) {
                    $role = json_decode($request->role);
                    foreach ($role as $item) {
                        $reoleAccount = new Roleaccount();
                        $reoleAccount->account = $account->id;
                        $reoleAccount->role = $item;
                        $reoleAccount->save();
                    }
                    return response()->json(['msg' => 'ok', 'data' => 'Lưu thành công'], Response::HTTP_OK);
                }
            } else {
                return response()->json(['msg' => 'fail', 'data' => 'Tên đăng nhập đã tổn tại vui lòng chọn tên khác'], Response::HTTP_OK);
            }
        } catch (\Exception $ex) {
            return response()->json(['msg' => 'fail', 'data' => 'Đã có lỗi xảy ra vui lòng kiểm tra lại', 'error' => $ex], Response::HTTP_OK);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'username' => 'required',
                    'password' => 'required|max:10|min:6',
                    'department' => 'required',
                    'name' => 'required',
                    'role' => 'required|json'
                ],
                [
                    'required' => 'Trường bắt buộc không được để trống',
                    'min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                    'max' => 'Mật khẩu không được quá 10 ký tự'
                ],
                [
                    'username' => 'Tên đăng nhập',
                    'password' => 'Mật khẩu',
                    'department' => "Đơn vị hành chính",
                    'name' => 'Tên',
                    'role' => 'Quyền'
                ]
            );

            if ($validate->fails()) {
                return response()->json(['msg' => 'fail', 'data' => $validate->errors()], Response::HTTP_OK);
            }

            $account = Account::find($id);
            $account->username = $request->username;
            if ($request->password != "undefined") {
                $account->password = Hash::make($request->password);
            }
            $account->name = $request->name;
            if ($account->save()) {
                $role = json_decode($request->role);
                $roleOld = Roleaccount::where('account', $id)->get();

                foreach ($roleOld as $old) {
                    Roleaccount::destroy($old->id);
                }

                foreach ($role as $item) {
                    $reoleAccount = new Roleaccount();
                    $reoleAccount->account = $id;
                    $reoleAccount->role = $item;
                    $reoleAccount->save();
                }
                return response()->json(['msg' => 'ok', 'data' => 'Lưu thành công'], Response::HTTP_OK);
            }
            return response()->json(['msg' => 'ok', 'data' => 'Lưu thành công'], Response::HTTP_OK);
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function destroy($id)
    {
        try {
            Account::destroy($id);
            return response()->json(['msg' => 'ok', 'data' => 'Xóa thành công'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            print($th);
        }
    }
}
