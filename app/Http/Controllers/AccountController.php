<?php

namespace App\Http\Controllers;

use App\Helpers\SessionHelper;
use App\Models\Account;
use App\Models\Roleaccount;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

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
        } catch (\Exception $th) {
            print($th);
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
