<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department\index');
    }

    public function all(Request $request)
    {
        if ($request->has('page')) {
            $list = Department::paginate(10);
            return response()->json($list);
        } else {
            $list = Department::all();
            return response()->json($list);
        }
    }

    public function store(Request $request)
    {
        try {
            $department = new Department();
            $department->name = $request->name;
            $department->address = $request->address;
            $department->commune = $request->commune;
            $department->district = $request->district;
            $department->province = $request->province;
            $department->phone = $request->phone;
            $department->email = $request->email;
            if ($request->parentDepartment == "") {
                $department->parentDepartment = null;
            } else {
                $department->parentDepartment = $request->parentDepartment;
            }
            $department->path = $request->path;
            if ($department->save()) {
                $account = new Account();
                $account->username = $request->username;
                $account->password = Hash::make($request->password);
                $account->unit = $department->id;
                $account->save();
            }
            return response()->json(['msg' => 'ok', 'data' => 'success'], Response::HTTP_OK);
        } catch (\Exception $th) {
            return response()->json(['msg' => 'ok', 'data' => $th], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Department $department)
    {
        return $department;
    }

    public function update(Request $request, $id)
    {
        try {
            $department = Department::find($id);
            $department->name = $request->name;
            $department->address = $request->address;
            $department->commune = $request->commune;
            $department->district = $request->district;
            $department->province = $request->province;
            $department->phone = $request->phone;
            $department->email = $request->email;
            $department->parentDepartment = $request->parentDepartment;
            $department->path = $request->path;
            if ($request->has('changePassword')) {
                $account = Account::where('unit', $id)->first();
                $account->username = $request->username;
                $account->password = Hash::make($request->password);
                $account->save();
            }
            return response()->json(['msg' => 'ok', 'data' => 'success'], Response::HTTP_OK);
        } catch (\Exception $th) {
            return response()->json(['msg' => 'ok', 'data' => $th], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id)
    {
        try {
            Department::destroy($id);
            $account = Account::where('unit', $id)->first();
            Account::destroy($account->id);
            return response()->json(['msg' => 'ok', 'data' => 'delete'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['msg' => 'ok', 'data' => $th], Response::HTTP_BAD_REQUEST);
        }
    }
}
