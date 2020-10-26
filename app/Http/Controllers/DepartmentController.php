<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department\index');
    }

    public function all(Request $request)
    {
        if ($request->has('all')) {
            $result = Department::all();
            return $result;
        }
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

    public function ValidateDepartment(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required',
                'commune' => 'required',
                'district' => 'required',
                'province' => 'required'
            ],
            [
                'required' => 'không được để trống',

            ],
            [
                'name' => 'Tên đơn vị hành chính',
                'address' => 'Địa chỉ',
                'commune' => 'Xã/Phường',
                'district' => 'Quận/Huyện',
                'province' => 'Tỉnh/Thành phố'
            ]
        );
        if ($validate->fails()) {
            return ['valid' => false, 'err' => $validate->errors()];
        }
    }


    public function store(Request $request)
    {
        try {
            $validate =  $this->ValidateDepartment($request);
            if ($validate['valid'] != false) {
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
                    return response()->json(['msg' => 'ok', 'data' => 'success'], Response::HTTP_OK);
                }
            } else {
                return response()->json(['msg' => 'fail', 'data' => $validate['err']], Response::HTTP_OK);
            }
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
                return response()->json(['msg' => 'ok', 'data' => 'success'], Response::HTTP_OK);
            } else {
                return response()->json(['msg' => 'ok', 'data' => "fail"], Response::HTTP_BAD_REQUEST);
            }
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
