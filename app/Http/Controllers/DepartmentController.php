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
        $result = Department::all()->toArray();
        $result = $this->buildTree($result);
        return response()->json($result);
    }
    function buildTree($elements, $parentId = 0)
    {

        $branch = array();

        foreach ($elements as $element) {

            if ($element['parentDepartment'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                unset($element);
            }
        }
        return $branch;
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
                $department->path = null;
            } else {
                $department->parentDepartment = $request->parentDepartment;
                $parent = Department::find($request->parentDepartment);
                if ($parent->path == null) {
                    $department->path = $parent->id;
                } else {
                    $department->path = $parent->path . "-" . $parent->id;
                }
            }

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
